<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CategorySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'name_uz') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'name_en') ?>

    <?php // echo $form->field($model, 'description_uz') ?>

    <?php // echo $form->field($model, 'description_ru') ?>

    <?php // echo $form->field($model, 'description_en') ?>

    <?php // echo $form->field($model, 'meta_title_uz') ?>

    <?php // echo $form->field($model, 'meta_title_ru') ?>

    <?php // echo $form->field($model, 'meta_title_en') ?>

    <?php // echo $form->field($model, 'meta_description_uz') ?>

    <?php // echo $form->field($model, 'meta_description_ru') ?>

    <?php // echo $form->field($model, 'meta_description_en') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
