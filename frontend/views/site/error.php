<?php
/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

use yii\helpers\Html;

$this->title = $name;

$is404 = (strpos($name, '404') !== false || strpos($message, 'not found') !== false || strpos($message, 'Not Found') !== false);
$code  = $is404 ? '404' : '500';
$emoji = $is404 ? '🔍' : '⚠️';
$hint  = $is404
    ? Yii::t('app', 'The page you are looking for does not exist or has been moved.')
    : Yii::t('app', 'An unexpected error occurred. Please try again later.');
?>

<style>
.error-page {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    text-align: center;
}
.error-code {
    font-size: clamp(80px, 18vw, 160px);
    font-weight: 800;
    line-height: 1;
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 8px;
}
.error-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}
.error-hint {
    color: #64748b;
    font-size: 1rem;
    max-width: 440px;
    margin: 0 auto 32px;
    line-height: 1.6;
}
.error-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}
.err-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all .2s;
}
.err-btn-primary {
    background: #2563eb;
    color: #fff;
}
.err-btn-primary:hover { background: #1d4ed8; color: #fff; }
.err-btn-outline {
    border: 1.5px solid #e2e8f0;
    color: #475569;
    background: #fff;
}
.err-btn-outline:hover { border-color: #2563eb; color: #2563eb; }
</style>

<div class="error-page">
    <div>
        <div class="error-code"><?= $code ?></div>
        <div class="error-title"><?= Html::encode($name) ?></div>
        <p class="error-hint"><?= $hint ?></p>
        <div class="error-actions">
            <a href="/" class="err-btn err-btn-primary">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6-.064.077A.5.5 0 0 0 2 8h1v5a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V8h1a.5.5 0 0 0 .418-.777L8.354 1.146zM8 2.207l5 5V13H3V7.207l5-5z"/>
                </svg>
                <?= Yii::t('app', 'Home page') ?>
            </a>
            <a href="javascript:history.back()" class="err-btn err-btn-outline">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                <?= Yii::t('app', 'Go back') ?>
            </a>
        </div>
    </div>
</div>
