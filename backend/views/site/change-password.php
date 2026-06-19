<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ChangePasswordForm $model */

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row justify-content-center">
    <div class="col-md-5">

        <div class="d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-shield-lock fs-4 text-primary"></i>
            <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
        </div>

        <div class="card">
            <div class="card-body">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'current_password')->passwordInput(['autocomplete' => 'current-password']) ?>
                <?= $form->field($model, 'new_password')->passwordInput(['autocomplete' => 'new-password']) ?>
                <?= $form->field($model, 'new_password_confirm')->passwordInput(['autocomplete' => 'new-password']) ?>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <?= Html::a(Yii::t('app', 'Cancel'), ['/site/index'], ['class' => 'btn btn-secondary']) ?>
                    <?= Html::submitButton(
                        '<i class="bi bi-check-lg me-1"></i>' . Yii::t('app', 'Save'),
                        ['class' => 'btn btn-success']
                    ) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>
