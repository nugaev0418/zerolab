<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang = Yii::$app->language;
$this->title = Yii::t('app', 'Направления');
?>

<div class="page-hero">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <span><?= Html::encode($this->title) ?></span>
        </div>
    </div>
</div>

<div class="container">
    <div class="direction-grid">
        <?php foreach ($directions as $direction): ?>
            <a href="<?= Url::to(['direction/view', 'slug' => $direction->slug]) ?>"
               class="direction-card">
                <div class="direction-card-icon">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16.016a7.5 7.5 0 0 0 1.962-14.74A1 1 0 0 0 9 0H7a1 1 0 0 0-.962 1.276A7.5 7.5 0 0 0 8 16.016zm6.5-7.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        <path d="m6.94 7.44 4.95-2.83-2.83 4.95-4.949 2.83 2.829-4.95z"/>
                    </svg>
                </div>
                <div class="direction-card-name"><?= Html::encode($direction->getName()) ?></div>
                <div class="direction-card-count">
                    <?= $direction->getProducts()->count() ?> <?= Yii::t('app', 'products') ?>
                </div>
            </a>
        <?php endforeach; ?>

        <?php if (empty($directions)): ?>
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#94a3b8;">
                <p><?= Yii::t('app', 'No directions found') ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
