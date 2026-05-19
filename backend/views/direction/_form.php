<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var $model common\models\Direction */

$form = ActiveForm::begin();

?>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Направление Ma'lumotlari
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->dropDownList([
                        1 => 'Active',
                        0 => 'No active'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'slug') ?>
                </div>
            </div>

            <hr>

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active"
                            data-bs-toggle="tab" data-bs-target="#uz">UZ</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link"
                            data-bs-toggle="tab" data-bs-target="#ru">RU</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link"
                            data-bs-toggle="tab" data-bs-target="#en">EN</button>
                </li>
            </ul>

            <div class="tab-content mt-3">

                <div class="tab-pane fade show active" id="uz">
                    <?= $form->field($model, 'name_uz') ?>
                    <?= $form->field($model, 'description_uz')->widget(\dosamigos\ckeditor\CKEditor::class, [
                        'options' => ['rows' => 6],
                        'preset' => 'standard',
                        'clientOptions' => [
                            'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                            'filebrowserUploadMethod' => 'form',
                        ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_uz') ?>
                    <?= $form->field($model, 'meta_description_uz')->textarea(['rows' => 3]) ?>
                </div>

                <div class="tab-pane fade" id="ru">
                    <?= $form->field($model, 'name_ru') ?>
                    <?= $form->field($model, 'description_ru')->widget(\dosamigos\ckeditor\CKEditor::class, [
                        'options' => ['rows' => 6],
                        'preset' => 'standard',
                        'clientOptions' => [
                            'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                            'filebrowserUploadMethod' => 'form',
                        ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_ru') ?>
                    <?= $form->field($model, 'meta_description_ru')->textarea(['rows' => 3]) ?>
                </div>

                <div class="tab-pane fade" id="en">
                    <?= $form->field($model, 'name_en') ?>
                    <?= $form->field($model, 'description_en')->widget(\dosamigos\ckeditor\CKEditor::class, [
                        'options' => ['rows' => 6],
                        'preset' => 'standard',
                        'clientOptions' => [
                            'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                            'filebrowserUploadMethod' => 'form',
                        ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_en') ?>
                    <?= $form->field($model, 'meta_description_en')->textarea(['rows' => 3]) ?>
                </div>

            </div>

        </div>
    </div>

    <div class="text-end mt-4">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

<?php ActiveForm::end(); ?>