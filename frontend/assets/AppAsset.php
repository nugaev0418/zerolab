<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';

    public $css = [
        'front/css/bootstrap.min.css',
        'css/site.css',
    ];

    public $js = [
        'front/js/bootstrap.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
