<?php
/** @var yii\web\View $this */

use common\models\Setting;
use yii\helpers\Html;

$lang  = Yii::$app->language;
$title = Setting::get('about_title') ?: Yii::t('app', 'About Us');
$this->title = $title;
?>

<style>
.about-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 60px;
    align-items: start;
    padding: 60px 0 80px;
}
@media (max-width: 768px) {
    .about-layout { grid-template-columns: 1fr; gap: 32px; padding: 40px 0 60px; }
}
.about-logo-wrap {
    position: sticky;
    top: 100px;
    text-align: center;
}
.about-logo-wrap img {
    width: 100%;
    max-width: 260px;
    height: auto;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,.08);
}
.about-content h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
}
.about-content p, .about-content li {
    color: #475569;
    line-height: 1.8;
    font-size: 1rem;
    margin-bottom: 16px;
}
.about-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 48px;
}
@media (max-width: 600px) {
    .about-stats { grid-template-columns: 1fr 1fr; }
}
.about-stat-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 20px;
    text-align: center;
}
.about-stat-num {
    font-size: 2rem;
    font-weight: 800;
    color: #2563eb;
    line-height: 1;
    margin-bottom: 6px;
}
.about-stat-label {
    font-size: 0.82rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .05em;
}
</style>

<div class="page-hero">
    <div class="container">
        <h1><?= Html::encode($title) ?></h1>
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <span><?= Html::encode($title) ?></span>
        </div>
    </div>
</div>

<div class="container">
    <div class="about-layout">
        <div class="about-logo-wrap">
            <img src="/logo.png" alt="<?= Html::encode($title) ?>">
        </div>
        <div class="about-content">
            <div class="about-text">
                <?= Setting::get('about_content') ?>
            </div>
        </div>
    </div>
</div>
