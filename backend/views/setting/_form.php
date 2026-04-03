<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        Asosiy Ma'lumotlar
    </div>

    <div class="card-body">

        <!-- Tabs -->
        <ul class="nav nav-tabs" role="tablist">
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

            <!-- UZ -->
            <div class="tab-pane fade show active" id="uz">
                <?= $form->field($model, 'site_name_uz') ?>
                <?= $form->field($model, 'about_title_uz') ?>
                <?= $form->field($model, 'about_content_uz')->textarea(['rows'=>4]) ?>
                <?= $form->field($model, 'address_uz') ?>
            </div>

            <!-- RU -->
            <div class="tab-pane fade" id="ru">
                <?= $form->field($model, 'site_name_ru') ?>
                <?= $form->field($model, 'about_title_ru') ?>
                <?= $form->field($model, 'about_content_ru')->textarea(['rows'=>4]) ?>
                <?= $form->field($model, 'address_ru') ?>
            </div>

            <!-- EN -->
            <div class="tab-pane fade" id="en">
                <?= $form->field($model, 'site_name_en') ?>
                <?= $form->field($model, 'about_title_en') ?>
                <?= $form->field($model, 'about_content_en')->textarea(['rows'=>4]) ?>
                <?= $form->field($model, 'address_en') ?>
            </div>

        </div>

    </div>
</div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            Kontakt Ma'lumotlari
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'phone') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'telegram') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'instagram') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'facebook') ?>
                </div>
            </div>

        </div>
    </div>

    <div class="text-end mt-4">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>