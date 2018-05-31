<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'DM4C PROJECT',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => false,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'A_oO749FOY5yXP9PAmwOL3YQ0g3yNuXw',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '1022716341457-f27n3jfgajncgub5i2qk7it0lkho8a74.apps.googleusercontent.com',
                    'clientSecret' => 'Zr7Oit-z-VTKsNh8yRVfAoPK',
                ]
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'entity-account',
                    'only' => ['index', 'view', 'options'],
                    'extraPatterns' => [

                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'product',
                    'only' => ['index', 'view', 'options'],
                    'extraPatterns' => [

                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'activitie',
                    'only' => ['index', 'view', 'options'],
                    'extraPatterns' => [

                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'cost-profit',
                    'only' => ['index', 'view', 'options', 'search'],
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                '' => '/site/index',
                '<controller:\w+>' => '<controller>/index',
                '<controller>/<action>' => '<controller>/<action>',
                '<action:\w+>' => 'user/<action>', // <-- use UserController by default
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
