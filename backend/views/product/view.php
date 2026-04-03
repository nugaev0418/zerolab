<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'category_id',
            'brand_id',
            'name_uz',
            'name_ru',
            'name_en',
            'catalog_number',
            'short_description_uz:ntext',
            'short_description_ru:ntext',
            'short_description_en:ntext',
            'description_uz:ntext',
            'description_ru:ntext',
            'description_en:ntext',
            'meta_title_uz',
            'meta_title_ru',
            'meta_title_en',
            'meta_description_uz:ntext',
            'meta_description_ru:ntext',
            'meta_description_en:ntext',
            'image',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
