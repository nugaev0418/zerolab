<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #1a1f2e 0%, #252b3b 50%, #1e2a45 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-logo .logo-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        .login-logo h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .login-logo p {
            color: #64748b;
            font-size: 13.5px;
            margin: 4px 0 0;
        }
        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 5px;
        }
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            padding: 9px 13px;
            font-size: 13.5px;
            transition: all .2s;
            width: 100%;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.12);
            outline: none;
        }
        .field-loginform-password input { margin-bottom: 4px; }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 11px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s;
            margin-top: 8px;
        }
        .btn-login:hover { opacity: .9; }
        .help-block { font-size: 12px; color: #ef4444; margin-top: 3px; }
        .has-error .form-control { border-color: #ef4444; }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="login-card">
    <div class="login-logo">
        <div class="logo-icon">
            <svg width="28" height="28" fill="none" viewBox="0 0 24 24">
                <path fill="#fff" d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.18L20 8.5v7L12 19.82 4 15.5v-7L12 4.18z"/>
            </svg>
        </div>
        <h1><?= Html::encode(Yii::$app->name) ?></h1>
        <p>Admin panelga kirish</p>
    </div>

    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
