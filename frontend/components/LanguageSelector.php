<?php

namespace frontend\components;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;
use common\models\Language;

class LanguageSelector extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'setLanguage',
        ];
    }

    public function setLanguage()
    {
        $requestLang = Yii::$app->request->get('lang');

        $languages = Language::find()
            ->where(['status' => 1])
            ->indexBy('code')
            ->all();

        if (empty($languages)) {
            throw new \yii\web\ServerErrorHttpException('No active languages configured.');
        }

        // Agar URL da til mavjud va DB da bor bo‘lsa
        if ($requestLang && isset($languages[$requestLang])) {
            $currentLanguage = $languages[$requestLang];
        } else {
            // Default til DB dan
            $currentLanguage = Language::find()
                ->where(['is_default' => 1, 'status' => 1])
                ->one();

            // Agar default belgilanmagan bo‘lsa birinchi aktiv til
            if (!$currentLanguage) {
                $currentLanguage = reset($languages);
            }
        }

        Yii::$app->language = $currentLanguage->code;
        Yii::$app->params['language_id'] = $currentLanguage->id;
    }
}
