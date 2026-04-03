<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',

    'language' => 'uz',

    'on beforeRequest' => function ($event) {
        $lang = Yii::$app->request->get('lang');
        if (in_array($lang, ['uz','ru','en'])) {
            Yii::$app->language = $lang;
        }
    },

    'components' => [
        'settings' => [
            'class' => 'common\components\SettingComponent',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'product/add-review' => 'product/add-review',
                'category/<slug>' => 'category/view',
                'product/<slug>' => 'product/view',
                'brand/<slug>' => 'brand/view',
                'shop' => 'shop/index',
            ],
        ],
    ],
    'params' => $params,
];
