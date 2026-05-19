<?php

/** @var yii\web\View $this */

use common\models\Product;
use common\models\Category;
use common\models\Brand;
use common\models\Direction;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Dashboard');

$productCount   = Product::find()->count();
$categoryCount  = Category::find()->count();
$brandCount     = Brand::find()->count();
$directionCount = Direction::find()->count();
?>

<div class="page-header">
    <h1 class="page-title"><?= Yii::t('app', 'Dashboard') ?></h1>
    <span style="color:#64748b;font-size:13px;"><?= date('d.m.Y') ?></span>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <div style="font-size:26px;font-weight:700;color:#1e293b;"><?= $productCount ?></div>
                <div style="font-size:13px;color:#64748b;"><?= Yii::t('app', 'Products') ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#10b981,#059669);">
                <i class="bi bi-folder2-open"></i>
            </div>
            <div>
                <div style="font-size:26px;font-weight:700;color:#1e293b;"><?= $categoryCount ?></div>
                <div style="font-size:13px;color:#64748b;"><?= Yii::t('app', 'Categories') ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                <i class="bi bi-award"></i>
            </div>
            <div>
                <div style="font-size:26px;font-weight:700;color:#1e293b;"><?= $brandCount ?></div>
                <div style="font-size:13px;color:#64748b;"><?= Yii::t('app', 'Brands') ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                <i class="bi bi-compass"></i>
            </div>
            <div>
                <div style="font-size:26px;font-weight:700;color:#1e293b;"><?= $directionCount ?></div>
                <div style="font-size:13px;color:#64748b;"><?= Yii::t('app', 'Directions') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-clock-history"></i> <?= Yii::t('app', 'Quick links') ?>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Add Product'),   ['/product/create'],   ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Add Category'),  ['/category/create'],  ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Add Direction'), ['/direction/create'], ['class' => 'btn btn-primary', 'style' => 'background:#8b5cf6;border-color:#8b5cf6']) ?>
                    <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Add Brand'),     ['/brand/create'],     ['class' => 'btn btn-warning text-white']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> <?= Yii::t('app', 'Information') ?>
            </div>
            <div class="card-body" style="color:#64748b;font-size:13.5px;line-height:1.8;">
                <p class="mb-1"><?= Yii::t('app', 'Site') ?>: <a href="/" target="_blank"><?= Yii::$app->request->hostInfo ?></a></p>
                <p class="mb-1"><?= Yii::t('app', 'Date') ?>: <?= date('d.m.Y H:i') ?></p>
                <p class="mb-0"><?= Yii::t('app', 'Admin') ?>: <strong><?= Html::encode(Yii::$app->user->identity->username ?? '—') ?></strong></p>
            </div>
        </div>
    </div>
</div>
