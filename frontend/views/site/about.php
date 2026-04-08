<?php

/** @var yii\web\View $this */

use common\models\Setting;
use yii\helpers\Html;

$this->title = Setting::get('about_title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center"><?= Html::encode($this->title) ?></div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <img class="thumbnail" src="/logo.png" alt="">
            </div>
            <div class="col-md-8">
                <p class="fs-6 lh-lg">
                    <?= Setting::get('about_content') ?>
                </p>
            </div>
        </div>
    </div>
</div>
