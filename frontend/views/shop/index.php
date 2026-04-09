<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Products');
?>


<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center"><?= Html::encode($this->title) ?></div>
    </div>
</div>

<div class="container my-5">

    <div class="row">

        <section class="flat-spacing-1">
            <div class="container">
<!--                <div class="tf-shop-control grid-3 align-items-center">-->
<!--                    <div class="tf-control-filter">-->
<!--                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filter</span></a>-->
<!--                    </div>-->
<!--                    <ul class="tf-control-layout d-flex justify-content-center">-->
<!---->
<!--                    </ul>-->
<!--                    <div class="tf-control-sorting d-flex justify-content-end">-->
<!--                        <div class="tf-dropdown-sort" data-bs-toggle="dropdown">-->
<!--                            <div class="btn-select">-->
<!--                                <span class="text-sort-value">Featured</span>-->
<!--                                <span class="icon icon-arrow-down"></span>-->
<!--                            </div>-->
<!--                            <div class="dropdown-menu">-->
<!--                                <div class="select-item active">-->
<!--                                    <span class="text-value-item">Featured</span>-->
<!--                                </div>-->
<!--                                <div class="select-item">-->
<!--                                    <span class="text-value-item">Best selling</span>-->
<!--                                </div>-->
<!--                                <div class="select-item" data-sort-value="a-z">-->
<!--                                    <span class="text-value-item">Alphabetically, A-Z</span>-->
<!--                                </div>-->
<!--                                <div class="select-item" data-sort-value="z-a">-->
<!--                                    <span class="text-value-item">Alphabetically, Z-A</span>-->
<!--                                </div>-->
<!--                                <div class="select-item" data-sort-value="price-low-high">-->
<!--                                    <span class="text-value-item">Price, low to high</span>-->
<!--                                </div>-->
<!--                                <div class="select-item" data-sort-value="price-high-low">-->
<!--                                    <span class="text-value-item">Price, high to low</span>-->
<!--                                </div>-->
<!--                                <div class="select-item">-->
<!--                                    <span class="text-value-item">Date, old to new</span>-->
<!--                                </div>-->
<!--                                <div class="select-item">-->
<!--                                    <span class="text-value-item">Date, new to old</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="tf-row-flex">
                    <aside class="tf-shop-sidebar wrap-sidebar-mobile">
                        <div class="widget-facet wd-categories">
                            <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                                <span>
                                    <?= Yii::t('app', 'Categories') ?>
                                </span>
                                <span class="icon icon-arrow-up"></span>
                            </div>
                            <div id="categories" class="collapse show">
                                <ul class="list-categoris current-scrollbar mb_36">
                                    <?php foreach ($categories as $cat): ?>

                                        <li class="cate-item <?= in_array($cat->id, (array)$selectedCategories) ? 'current' : '' ?>">

                                            <a href="<?= \yii\helpers\Url::current([
                                                    'category' => [$cat->id]
                                            ]) ?>">

                                                <span><?= $cat->getName() ?></span>

                                                <span>(<?= $cat->getProducts()->count() ?>)</span>

                                            </a>

                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </aside>
                    <div class="wrapper-control-shop tf-shop-content gridLayout-wrapper">
                        <div class="meta-filter-shop" style="display: none;">
                            <div id="product-count-grid" class="count-text"><span class="count">12</span> Products Found</div>
                            <div id="product-count-list" class="count-text"><span class="count">8</span> Products Found</div>
                            <div id="applied-filters"></div>
                            <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i class="icon icon-close"></i></button>
                        </div>

                        <div class="tf-grid-layout wrapper-shop tf-col-3">

                            <?= \yii\widgets\ListView::widget([
                                    'dataProvider' => $dataProvider,

                                    'layout' => "{items}\n<div class='text-center mt-4'>{pager}</div>",

                                    'options' => [
                                            'tag' => false, // 🔥 ENG MUHIM
                                    ],

                                    'itemOptions' => [
                                            'tag' => false,
                                    ],

                                    'itemView' => function ($model) {
                                        return $this->render('_product_card', ['model' => $model]);
                                    },
                            ]) ?>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

</div>