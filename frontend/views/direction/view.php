<?php
use yii\helpers\Html;
use yii\helpers\Url;

$lang = Yii::$app->language;
$this->title = $direction->{'meta_title_' . $lang} ?: $direction->{'name_' . $lang};
?>

<div class="page-hero">
    <div class="container">
        <h1><?= Html::encode($direction->{'name_' . $lang}) ?></h1>
        <div class="breadcrumb-hero">
            <a href="/"><?= Yii::t('app', 'Home page') ?></a>
            <span>›</span>
            <a href="<?= Url::to(['direction/index']) ?>"><?= Yii::t('app', 'Направления') ?></a>
            <span>›</span>
            <span><?= Html::encode($direction->{'name_' . $lang}) ?></span>
        </div>
    </div>
</div>

<div class="container" style="padding: 40px 0 60px;">
    <div class="product-grid">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <?= $this->render('/shop/_product_card', ['model' => $model]) ?>
        <?php endforeach; ?>

        <?php if ($dataProvider->getTotalCount() === 0): ?>
            <div class="empty-state">
                <svg width="64" height="64" fill="#94a3b8" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/>
                </svg>
                <h4><?= Yii::t('app', 'No products found') ?></h4>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($dataProvider->getPagination()->getPageCount() > 1): ?>
    <div class="pagination-wrap">
        <?= \yii\widgets\LinkPager::widget([
            'pagination'  => $dataProvider->getPagination(),
            'options'     => ['class' => 'pagination'],
            'linkOptions' => ['class' => 'page-link'],
            'pageCssClass' => 'page-item',
            'activePageCssClass' => 'active',
            'firstPageLabel' => '«',
            'lastPageLabel'  => '»',
            'prevPageLabel'  => '‹',
            'nextPageLabel'  => '›',
        ]) ?>
    </div>
    <?php endif; ?>
</div>
