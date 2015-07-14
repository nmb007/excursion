<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Main',
            // ... other configurations for the module ...
        ],
        'user' => [
            'class' => 'app\modules\user\User',
            // ... other configurations for the module ...
        ],
        'post' => [
            'class' => 'app\modules\post\Post',
            // ... other configurations for the module ...
        ],
        'gallery' => [
            'class' => 'app\modules\gallery\Gallery',
            // ... other configurations for the module ...
        ],
        'testimonial' => [
            'class' => 'app\modules\testimonial\Testimonial',
            // ... other configurations for the module ...
        ],
    ],
    'defaultRoute' => 'main/default/index',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DrNCQVnxm6vs1SgvHbIeVIAKuwE92mpK',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'tours' => 'post/tours/index',
                'gallery' => 'gallery/gallery/index',
                'testimonials' => 'testimonial/testimonial/index',
                'blog' => 'post/blog/index',
                'contact' => 'user/user/contact',
                'logout' => 'user/user/logout',
                'user/index' => 'user/user/index',
                'user/create' => 'user/user/create',
                
                '/post/admin' => 'post/post/admin',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
