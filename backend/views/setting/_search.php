<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SettingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'site_name_uz') ?>

    <?= $form->field($model, 'site_name_ru') ?>

    <?= $form->field($model, 'site_name_en') ?>

    <?= $form->field($model, 'about_title_uz') ?>

    <?php // echo $form->field($model, 'about_title_ru') ?>

    <?php // echo $form->field($model, 'about_title_en') ?>

    <?php // echo $form->field($model, 'about_content_uz') ?>

    <?php // echo $form->field($model, 'about_content_ru') ?>

    <?php // echo $form->field($model, 'about_content_en') ?>

    <?php // echo $form->field($model, 'address_uz') ?>

    <?php // echo $form->field($model, 'address_ru') ?>

    <?php // echo $form->field($model, 'address_en') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telegram') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
