<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Setting $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="setting-view">

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
            'site_name_uz',
            'site_name_ru',
            'site_name_en',
            'about_title_uz',
            'about_title_ru',
            'about_title_en',
            'about_content_uz:ntext',
            'about_content_ru:ntext',
            'about_content_en:ntext',
            'address_uz:ntext',
            'address_ru:ntext',
            'address_en:ntext',
            'phone',
            'email:email',
            'telegram',
            'instagram',
            'facebook',
            'updated_at',
        ],
    ]) ?>

</div>
