<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'front/fonts/fonts.css',
        'front/fonts/font-icons.css',
        'front/css/bootstrap.min.css',
        'front/css/swiper-bundle.min.css',
        'front/css/animate.css',
        'front/css/styles.css',
        'css/site.css',
    ];
    public $js = [
        'front/js/bootstrap.min.js',
        'front/js/jquery.min.js',
        'front/js/swiper-bundle.min.js',
        'front/js/carousel.js',
        'front/js/bootstrap-select.min.js',
        'front/js/lazysize.min.js',
        'front/js/bootstrap-select.min.js',
        'front/js/count-down.js',
        'front/js/wow.min.js',
        'front/js/multiple-modal.js',
        'front/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
