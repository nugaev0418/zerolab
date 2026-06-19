<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Slider $model */

$lang = substr(Yii::$app->language, 0, 2);

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);
?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center gap-2">
        <i class="bi bi-translate"></i>
        <?= Yii::t('app', 'Translations') ?>
    </div>
    <div class="card-body">

        <!-- Language tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <?php foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label): ?>
                <li class="nav-item">
                    <button type="button"
                            class="nav-link <?= $lang === $code ? 'active' : '' ?>"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-<?= $code ?>">
                        <?= $label ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content mt-3">

            <?php foreach (['uz' => 'UZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label): ?>
                <div class="tab-pane fade <?= $lang === $code ? 'show active' : '' ?>" id="tab-<?= $code ?>">
                    <?= $form->field($model, 'title_' . $code)->textInput(['maxlength' => true])->label(Yii::t('app', 'Title') . " ($label)") ?>
                    <?= $form->field($model, 'text_' . $code)->textarea(['rows' => 4])->label(Yii::t('app', 'Text') . " ($label)") ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light d-flex align-items-center gap-2">
        <i class="bi bi-sliders"></i>
        <?= Yii::t('app', 'Settings') ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => 'https://...']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'sort_order')->input('number', ['min' => 0]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'status')->dropDownList([
                    1 => Yii::t('app', 'Active'),
                    0 => Yii::t('app', 'Inactive'),
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light d-flex align-items-center gap-2">
        <i class="bi bi-image"></i>
        <?= Yii::t('app', 'Image') ?>
    </div>
    <div class="card-body">
        <div class="row align-items-start">
            <div class="col-md-6">
                <?= $form->field($model, 'imageFile')->widget(FileInput::class, [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'initialPreview'        => $model->image
                            ? ['/upload/slider/' . $model->image]
                            : [],
                        'initialPreviewAsData'  => true,
                        'overwriteInitial'      => true,
                        'showUpload'            => false,
                        'showRemove'            => true,
                        'browseLabel'           => Yii::t('app', 'Choose image'),
                        'removeLabel'           => Yii::t('app', 'Remove'),
                        'maxFileCount'          => 1,
                        'layoutTemplates'       => ['footer' => '<div class="file-thumbnail-footer"></div>'],
                    ],
                ])->label(false) ?>
                <div class="form-text text-muted"><?= Yii::t('app', 'JPG, PNG, WEBP. Recommended: 1920×600px') ?></div>
            </div>
            <?php if ($model->image): ?>
                <div class="col-md-6 text-center">
                    <img src="/upload/slider/<?= Html::encode($model->image) ?>"
                         class="img-fluid rounded border"
                         style="max-height:160px;object-fit:cover;width:100%;">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="text-end">
    <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-secondary me-2']) ?>
    <?= Html::submitButton('<i class="bi bi-check-lg me-1"></i>' . Yii::t('app', 'Save'), [
        'class' => 'btn btn-success btn-lg',
    ]) ?>
</div>

<?php ActiveForm::end(); ?>
