<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Direction;
use common\models\Product;

class DirectionController extends Controller
{
    public function actionIndex()
    {
        $directions = Direction::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->all();

        return $this->render('index', [
            'directions' => $directions,
        ]);
    }

    public function actionView($slug)
    {
        $direction = Direction::find()
            ->where(['slug' => $slug, 'status' => 1])
            ->one();

        if (!$direction) {
            throw new NotFoundHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()
                ->where(['direction_id' => $direction->id, 'status' => 1])
                ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('view', [
            'direction' => $direction,
            'dataProvider' => $dataProvider,
        ]);
    }
}
