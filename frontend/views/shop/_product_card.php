<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang  = Yii::$app->language;
$image = $model->mainImage->image ?? null;
?>

<div class="product-card">

    <div class="product-card-img">
        <a href="<?= Url::to(['product/view', 'slug' => $model->slug]) ?>">
            <?php if ($image): ?>
                <img src="/upload/product/<?= Html::encode($image) ?>"
                     alt="<?= Html::encode($model->getName()) ?>"
                     loading="lazy">
            <?php else: ?>
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f1f5f9;">
                    <svg width="48" height="48" fill="#cbd5e1" viewBox="0 0 24 24">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                </div>
            <?php endif; ?>
        </a>

        <?php if ($model->category): ?>
            <span class="product-card-badge"><?= Html::encode($model->category->getName()) ?></span>
        <?php endif; ?>
    </div>

    <div class="product-card-body">
        <?php if ($model->direction): ?>
            <div class="product-card-cat"><?= Html::encode($model->direction->getName()) ?></div>
        <?php endif; ?>

        <a href="<?= Url::to(['product/view', 'slug' => $model->slug]) ?>"
           class="product-card-title">
            <?= Html::encode($model->getName()) ?>
        </a>

        <div class="product-card-meta">
            <span class="product-card-brand">
                <?php if ($model->brand): ?>
                    <?= Html::encode($model->brand->getName()) ?>
                <?php endif; ?>
            </span>
            <a href="<?= Url::to(['product/view', 'slug' => $model->slug]) ?>"
               class="product-card-btn">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
                <?= Yii::t('app', 'More') ?>
            </a>
        </div>
    </div>

</div>
