<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Category;
use common\models\Product;

class CategoryController extends Controller
{
    public function actionView($slug)
    {
        $category = Category::find()
            ->where(['slug' => $slug, 'status' => 1])
            ->one();

        if (!$category) {
            throw new NotFoundHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()
                ->where(['category_id' => $category->id, 'status' => 1])
                ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('view', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }
}