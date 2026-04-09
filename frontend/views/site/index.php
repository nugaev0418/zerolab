<?php

/** @var yii\web\View $this */

$this->title = \common\models\Setting::get('site_name');
?>


<!--SLIDER-->
<div class="tf-slideshow slider-home-2 slider-effect-fade position-relative">
    <div dir="ltr"
         class="swiper tf-sw-slideshow swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
         data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true"
         data-auto-play="true" data-delay="2000" data-speed="1000">
        <div class="swiper-wrapper">

            <?php foreach ($sliders as $slider): ?>

                <div class="swiper-slide">

                    <div class="wrap-slider">

                        <img src="/upload/slider/<?= $slider->image ?>"
                             alt="<?= $slider->getTitle() ?>">

                        <div class="box-content">
                            <div class="container">

                                <h1 class="fade-item fade-item-1">
                                    <?= $slider->getTitle() ?>
                                </h1>

                                <p class="fade-item fade-item-2">
                                    <?= $slider->getText() ?>
                                </p>

                                <?php if ($slider->url): ?>
                                    <a href="<?= $slider->url ?>"
                                       class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3">

                                        <span>
                                            <?=Yii::t('app', 'More')?>
                                        </span>
                                        <i class="icon icon-arrow-right"></i>

                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    <div class="wrap-pagination sw-absolute-2">
        <div class="container">
            <div class="sw-dots sw-pagination-slider swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                <span class="swiper-pagination-bullet" tabindex="0" role="button"
                      aria-label="Go to slide 1"></span><span
                        class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                        aria-label="Go to slide 2" aria-current="true"></span><span class="swiper-pagination-bullet"
                                                                                    tabindex="0" role="button"
                                                                                    aria-label="Go to slide 3"></span>
            </div>
        </div>
    </div>
</div>
<!--END SLIDER-->

<!--CATEGORY-->
<section class="flat-spacing-9">
    <div class="container-full">
        <div class="flat-title wow fadeInUp align-items-start" data-wow-delay="0s"
             style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
            <span class="title fw-6">
                <?=Yii::t('app', 'Shop by categories')?>
            </span>
        </div>
        <div class="hover-sw-nav">
            <div dir="ltr"
                 class="swiper tf-sw-collection swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                 data-preview="6" data-tablet="4" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15"
                 data-loop="false" data-auto-play="false">
                <div class="swiper-wrapper">

                    <?php foreach ($categories as $cat): ?>

                        <div class="swiper-slide">

                            <div class="collection-item style-2 hover-img">

                                <div class="collection-inner">

                                    <a href="<?= \yii\helpers\Url::to(['shop/index', 'category' => $cat->id]) ?>"
                                       class="collection-image img-style radius-20">

                                        <img
                                                src="/upload/category/<?= $cat->image ?? 'collection-drinkwear-6.jpg' ?>"
                                                alt="<?= $cat->getName() ?>">

                                    </a>

                                    <div class="collection-content">

                                        <a href="<?= \yii\helpers\Url::to(['shop/index', 'category' => $cat->id]) ?>"
                                           class="tf-btn collection-title hover-icon fs-15 text-truncate">

                        <span class="text-truncate">
                            <?= $cat->getName() ?>
                        </span>

                                            <i class="icon icon-arrow1-top-left"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
            <div class="nav-sw nav-next-slider nav-next-collection box-icon w_46 round swiper-button-disabled"
                 tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-f5201395692d7732"
                 aria-disabled="true"><span class="icon icon-arrow-left"></span></div>
            <div class="nav-sw nav-prev-slider nav-prev-collection box-icon w_46 round" tabindex="0" role="button"
                 aria-label="Next slide" aria-controls="swiper-wrapper-f5201395692d7732" aria-disabled="false"><span
                        class="icon icon-arrow-right"></span></div>
            <div class="sw-dots style-2 sw-pagination-collection justify-content-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                      aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet"
                                                                                  tabindex="0" role="button"
                                                                                  aria-label="Go to slide 2"></span>
            </div>
        </div>
    </div>
</section>
<!--END CATEGORY-->

<!--NEW PRODUCTS-->
<section class="flat-spacing-6">
    <div class="container">
        <div class="flat-title mb_2 gap-14">
            <span class="title wow fadeInUp" data-wow-delay="0s"
                  style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                <?=Yii::t('app', 'New Arrivals')?>
            </span>

        </div>
        <div>

        </div>
        <div class="grid-layout loadmore-item" data-grid="grid-4">

            <?php foreach ($products as $product): ?>

                <?php
                $image = $product->mainImage->image ?? 'no-image.jpg';
                ?>

                <div class="card-product style-4 fl-item">

                    <div class="card-product-wrapper">

                        <a href="<?= \yii\helpers\Url::to(['product/view', 'slug'=>$product->slug]) ?>"
                           class="product-img">

                            <img class="img-product"
                                 src="/upload/product/<?= $image ?>"
                                 alt="<?= $product->getName() ?>">

                            <!-- hover image (agar bo‘lsa) -->
                            <img class="img-hover"
                                 src="/upload/product/<?= $image ?>"
                                 alt="<?= $product->getName() ?>">

                        </a>

                        <div class="list-product-btn column-right">
                            <a href="#" class="box-icon wishlist bg_white round">
                                <span class="icon icon-heart"></span>
                            </a>

                            <a href="#" class="box-icon quickview bg_white round">
                                <span class="icon icon-view"></span>
                            </a>
                        </div>

                    </div>

                    <div class="card-product-info">

                        <a href="<?= \yii\helpers\Url::to(['product/view', 'slug'=>$product->slug]) ?>"
                           class="title link">

                            <?= $product->getName() ?>

                        </a>

                        <span class="price">
                <?= $product->price ?? '' ?>
            </span>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>
        <div class="tf-pagination-wrap view-more-button text-center">
            <a href="/shop" class="btn btn-outline">
                <?= Yii::t('app', 'Show all products') ?>
            </a>
        </div>
    </div>
</section>
<!--END NEW PRODUCTS-->