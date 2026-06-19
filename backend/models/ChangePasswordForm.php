<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirm = '';

    public function rules(): array
    {
        return [
            [['current_password', 'new_password', 'new_password_confirm'], 'required'],
            [['new_password', 'new_password_confirm'], 'string', 'min' => 6],
            ['new_password_confirm', 'compare', 'compareAttribute' => 'new_password'],
            ['current_password', 'validateCurrentPassword'],
        ];
    }

    public function validateCurrentPassword(): void
    {
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->current_password)) {
            $this->addError('current_password', Yii::t('app', 'Current password is incorrect.'));
        }
    }

    public function attributeLabels(): array
    {
        return [
            'current_password'    => Yii::t('app', 'Current Password'),
            'new_password'        => Yii::t('app', 'New Password'),
            'new_password_confirm'=> Yii::t('app', 'Confirm New Password'),
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = Yii::$app->user->identity;
        $user->setPassword($this->new_password);
        $user->generateAuthKey();

        return $user->save(false);
    }
}
