<?php

use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\Category;
use common\models\Brand;

$form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);

$categoryList = ArrayHelper::map(Category::find()->all(),'id','name_uz');
$brandList = ArrayHelper::map(Brand::find()->all(),'id','name_uz');


$initialPreview = [];
$initialPreviewConfig = [];

$frontendBaseUrl = str_replace('/backend/web', '/frontend/web', Yii::$app->request->baseUrl);

if (!$model->isNewRecord) {
    foreach ($model->images as $img) {


        $initialPreview[] = $frontendBaseUrl . '/upload/product/' . $img->image;

        $initialPreviewConfig[] = [
                'caption' => $img->image,
                'key' => $img->id,
                'url' => \yii\helpers\Url::to(['product/delete-image']),
        ];
    }
}

?>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Asosiy ma'lumotlar
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                                    'data' => $categoryList,
                                    'options' => ['placeholder'=>'Category tanlang...'],
                                    'pluginOptions' => ['allowClear'=>true],
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'brand_id')->widget(Select2::class, [
                                    'data' => $brandList,
                                    'options' => ['placeholder'=>'Brand tanlang...'],
                                    'pluginOptions' => ['allowClear'=>true],
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'status')->dropDownList([
                                    1=>'Active',
                                    0=>'No active'
                            ]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'catalog_number') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                        <?= $form->field($model, 'imageFile')->widget(FileInput::class, [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                        'initialPreview' => $model->image
                                                ? [$frontendBaseUrl . '/upload/product/' . $model->image]
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
                        ]) ?>
                </div>

            </div>


            <hr>

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
                    <?= $form->field($model, 'short_description_uz')->textarea(['rows'=>3]) ?>
<!--                    --><?php //= $form->field($model, 'description_uz')->textarea(['rows'=>5]) ?>
                    <?= $form->field($model, 'description_uz')->widget(\dosamigos\ckeditor\CKEditor::class, [
                            'options' => ['rows' => 6],
                            'preset' => 'standard',
                            'clientOptions' => [
                                    'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                                    'filebrowserUploadMethod' => 'form',
                            ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_uz') ?>
                    <?= $form->field($model, 'meta_description_uz')->textarea(['rows'=>3]) ?>
                </div>

                <div class="tab-pane fade" id="ru">
                    <?= $form->field($model, 'name_ru') ?>
                    <?= $form->field($model, 'short_description_ru')->textarea(['rows'=>3]) ?>
                    <?= $form->field($model, 'description_ru')->widget(\dosamigos\ckeditor\CKEditor::class, [
                            'options' => ['rows' => 6],
                            'preset' => 'standard',
                            'clientOptions' => [
                                    'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                                    'filebrowserUploadMethod' => 'form',
                            ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_ru') ?>
                    <?= $form->field($model, 'meta_description_ru')->textarea(['rows'=>3]) ?>
                </div>

                <div class="tab-pane fade" id="en">
                    <?= $form->field($model, 'name_en') ?>
                    <?= $form->field($model, 'short_description_en')->textarea(['rows'=>3]) ?>
                    <?= $form->field($model, 'description_en')->widget(\dosamigos\ckeditor\CKEditor::class, [
                            'options' => ['rows' => 6],
                            'preset' => 'standard',
                            'clientOptions' => [
                                    'filebrowserUploadUrl' => \yii\helpers\Url::to(['product/ck-upload']),
                                    'filebrowserUploadMethod' => 'form',
                            ],
                    ]) ?>
                    <?= $form->field($model, 'meta_title_en') ?>
                    <?= $form->field($model, 'meta_description_en')->textarea(['rows'=>3]) ?>
                </div>

            </div>


            <div class="row">
                <div class="col">
                        <?= $form->field($model, 'galleryFiles[]')->widget(FileInput::class, [
                                'options' => ['multiple' => true],
                                'pluginOptions' => [
                                        'initialPreview' => $initialPreview,
                                        'initialPreviewAsData' => true,
                                        'initialPreviewConfig' => $initialPreviewConfig,
                                        'overwriteInitial' => false,
                                        'showUpload' => false,

                                ],
                                'pluginEvents' => [
                                        "filesorted" => "function(event, params) {
                                        let order = params.stack.map(item => item.key);
                            
                                        $.post('" . \yii\helpers\Url::to(['product/sort-images']) . "', {
                                            order: order,
                                            _csrf: yii.getCsrfToken()
                                        });
                                    }",
                                ],
                        ]) ?>
                </div>
            </div>

        </div>
    </div>

    <div class="text-end mt-4">
        <?= Html::submitButton('Saqlash',['class'=>'btn btn-success btn-lg']) ?>
    </div>

<?php ActiveForm::end(); ?>