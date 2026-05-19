<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Kirish';
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "<div class=\"mb-3\">{label}\n{input}\n{error}</div>",
        'labelOptions' => ['class' => 'form-label'],
        'inputOptions' => ['class' => 'form-control'],
        'errorOptions' => ['class' => 'help-block'],
    ],
]); ?>

    <?= $form->field($model, 'username')->textInput([
        'autofocus' => true,
        'placeholder' => 'Login',
        'class' => 'form-control',
    ])->label('Foydalanuvchi nomi') ?>

    <?= $form->field($model, 'password')->passwordInput([
        'placeholder' => '••••••••',
        'class' => 'form-control',
    ])->label('Parol') ?>

    <?= $form->field($model, 'rememberMe')->checkbox()->label('Eslab qolish') ?>

    <button type="submit" class="btn-login">
        Kirish
    </button>

<?php ActiveForm::end(); ?>
