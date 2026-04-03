<?php

use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = $category->{'meta_title_' . Yii::$app->language} ?: $category->{'name_' . Yii::$app->language};

?>

<h1><?= Html::encode($category->{'name_' . Yii::$app->language}) ?></h1>

<div class="row">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-md-3 mb-4'],
        'itemView' => function ($model) {
            return $this->render('_product_item', ['model' => $model]);
        },
        'layout' => "{items}\n<div class='text-center'>{pager}</div>",
    ]) ?>
</div>