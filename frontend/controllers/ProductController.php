<?php

namespace frontend\controllers;

use common\models\ProductReview;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Product;

class ProductController extends Controller
{
    public function actionView($slug)
    {
        $model = Product::find()
            ->with(['category', 'brand', 'reviews', 'images'])
            ->where(['slug'=>$slug])
            ->one();

        $reviewModel = new ProductReview();

        if ($reviewModel->load(Yii::$app->request->post())) {
            $reviewModel->product_id = $model->id;
            $reviewModel->save(false);
            return $this->refresh();
        }

        return $this->render('view', [
            'model'=>$model,
            'reviewModel'=>$reviewModel,
        ]);
    }

    public function actionAddReview()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new ProductReview();


        if ($model->load(Yii::$app->request->post(), '')) {

            $model->created_at = time();

            if ($model->save()) {

                return [
                    'success' => true,
                    'html' => $this->renderPartial('_review_item', [
                        'review' => $model
                    ])
                ];
            }
        }


        return [
            'success' => false,
            'errors' => $model->errors
        ];
    }
}