<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SliderSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="slider-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title_uz') ?>

    <?= $form->field($model, 'title_ru') ?>

    <?= $form->field($model, 'title_en') ?>

    <?= $form->field($model, 'text_uz') ?>

    <?php // echo $form->field($model, 'text_ru') ?>

    <?php // echo $form->field($model, 'text_en') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
