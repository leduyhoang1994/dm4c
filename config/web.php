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
    'on beforeAction' => require(__DIR__ . '/before-action.php'),
    'components' => [
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
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
            'identityCookie' => ['name' => '_identity-dm4c', 'httpOnly' => true],
            'on afterLogin' => require(__DIR__ . '/after-login.php'),
            'on beforeLogout' => require(__DIR__ . '/before-logout.php'),
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
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'smtp.gmail.com',
                'port' => '587',
 
                'username' => 'dm4c@topica.asia',
                'password' => 'topicahn',
            ]
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'trace'],
                    'categories' => [
                        'yii\db\Command::query',
                    ],
                    'logVars' => [],
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
                    'only' => ['index', 'view', 'options', 'search'],
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'product',
                    'only' => ['index', 'view', 'options', 'search'],
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'activitie',
                    'only' => ['index', 'view', 'options', 'search'],
                    'extraPatterns' => [
                        'POST search' => 'search'
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
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'user-service',
                    'only' => ['login'],
                    'extraPatterns' => [
                        'POST login' => 'login'
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
