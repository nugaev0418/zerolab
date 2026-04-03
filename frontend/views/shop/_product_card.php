<?php
use yii\helpers\Url;

$image = $model->mainImage->image ?? 'no-image.jpg';
?>

<div class="card-product grid">

    <div class="card-product-wrapper">

        <a href="<?= Url::to(['product/view', 'slug'=>$model->slug]) ?>" class="product-img">

            <img class="img-product"
                 src="/upload/product/<?= $image ?>"
                 alt="<?= $model->getName() ?>">

        </a>

        <div class="list-product-btn absolute-2">
            <a href="#" class="box-icon bg_white quick-add">
                <span class="icon icon-bag"></span>
            </a>

            <a href="#" class="box-icon bg_white wishlist">
                <span class="icon icon-heart"></span>
            </a>
        </div>

    </div>

    <div class="card-product-info">

        <a href="<?= Url::to(['product/view', 'slug'=>$model->slug]) ?>"
           class="title link">
            <?= $model->getName() ?>
        </a>

        <span class="price current-price">
            <?= $model->price ?? '' ?>
        </span>

    </div>



</div>