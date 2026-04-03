<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

$form = ActiveForm::begin([
'options' => ['enctype' => 'multipart/form-data']
]);

$frontendBaseUrl = str_replace('/backend/web', '/frontend/web', Yii::$app->request->baseUrl);
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        Asosiy ma'lumotlar
    </div>

    <div class="card-body">



        <!-- Tillar -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button type="button" class="nav-link active"
                        data-bs-toggle="tab" data-bs-target="#uz">
                    UZ
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link"
                        data-bs-toggle="tab" data-bs-target="#ru">
                    RU
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link"
                        data-bs-toggle="tab" data-bs-target="#en">
                    EN
                </button>
            </li>
        </ul>

        <div class="tab-content mt-3">

            <div class="tab-pane fade show active" id="uz">
                <?= $form->field($model, 'name_uz') ?>
                <?= $form->field($model, 'meta_title_uz') ?>
                <?= $form->field($model, 'meta_description_uz')->textarea(['rows'=>3]) ?>
            </div>

            <div class="tab-pane fade" id="ru">
                <?= $form->field($model, 'name_ru') ?>
                <?= $form->field($model, 'meta_title_ru') ?>
                <?= $form->field($model, 'meta_description_ru')->textarea(['rows'=>3]) ?>
            </div>

            <div class="tab-pane fade" id="en">
                <?= $form->field($model, 'name_en') ?>
                <?= $form->field($model, 'meta_title_en') ?>
                <?= $form->field($model, 'meta_description_en')->textarea(['rows'=>3]) ?>
            </div>

        </div>


        <hr>

        <div class="row">
            <div class="col-md-8">
                <!-- Logo upload -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        Brand Logo
                    </div>
                    <div class="card-body text-center">

                        <?= $form->field($model, 'logoFile')->widget(FileInput::class, [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                        'initialPreview' => $model->logo
                                                ? [$frontendBaseUrl . '/upload/brand/' . $model->logo]
                                                : [],
                                        'initialPreviewAsData' => true,
                                        'overwriteInitial' => true,
                                        'showUpload' => false,
                                        'showRemove' => true,
                                        'browseLabel' => 'Rasm tanlang',
                                        'removeLabel' => 'O‘chirish',
                                        'maxFileCount' => 1,
                                        'layoutTemplates' => [
                                                'footer' => '<div class="file-thumbnail-footer"></div>',
                                        ],
                                ],
                        ])->label(false) ?>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'slug') ?>
                <?= $form->field($model, 'status')->dropDownList([
                        1 => 'Active',
                        0 => 'No active'
                ]) ?>
            </div>
        </div>



    </div>
</div>

<div class="text-end mt-4">
    <?= Html::submitButton('Saqlash', ['class'=>'btn btn-success btn-lg']) ?>
</div>

<?php ActiveForm::end(); ?>