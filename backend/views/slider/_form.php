<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Slider $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'] // 🔥 MUHIM
    ]); ?>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'title_uz')->textInput() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'title_ru')->textInput() ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'title_en')->textInput() ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'text_uz')->textarea(['rows' => 3]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'text_ru')->textarea(['rows' => 3]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'text_en')->textarea(['rows' => 3]) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'url')->textInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'sort_order')->input('number') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([
                    1 => 'Active',
                    0 => 'Inactive'
            ]) ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'imageFile')->fileInput(['class' => 'form-control']) ?>

            <?php if ($model->image): ?>
                <img src="/upload/slider/<?= $model->image ?>"
                     style="width:150px; margin-top:10px;">
            <?php endif; ?>

        </div>

    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('💾 Save', [
                'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
