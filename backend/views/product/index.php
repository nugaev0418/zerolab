<?php

use common\models\Brand;
use common\models\Category;
use common\models\Product;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_uz',

            [
                    'attribute' => 'category_id',
                    'value' => function ($model) {
                        return $model->category->name_uz ?? '';
                    },
                    'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'category_id',
                            'data' => Category::getTreeList(),
                            'options' => ['placeholder' => 'Category tanlang...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                            ],
                    ]),
            ],
            [
                    'attribute' => 'brand_id',
                    'value' => function ($model) {
                        return $model->brand->name_uz ?? '';
                    },
                    'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'brand_id',
                            'data' => ArrayHelper::map(Brand::find()->all(), 'id', 'name_uz'),
                            'options' => ['placeholder' => 'Brand tanlang...'],
                            'pluginOptions' => [
                                    'allowClear' => true,
                            ],
                    ]),
            ],
//            'slug',

            //'name_ru',
            //'name_en',
            //'catalog_number',
            //'short_description_uz:ntext',
            //'short_description_ru:ntext',
            //'short_description_en:ntext',
            //'description_uz:ntext',
            //'description_ru:ntext',
            //'description_en:ntext',
            //'meta_title_uz',
            //'meta_title_ru',
            //'meta_title_en',
            //'meta_description_uz:ntext',
            //'meta_description_ru:ntext',
            //'meta_description_en:ntext',
            //'image',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
