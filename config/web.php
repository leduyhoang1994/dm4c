<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$config = [
    'id' => 'basic',
    'name' => 'List Master',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'on beforeAction' => require(__DIR__ . '/before-action.php'),
    'on afterAction' => require(__DIR__ . '/after-action.php'),
    'controllerMap' => [
        'cdt_list' => 'app\controllers\CostProfitController',
        'pt_list' => 'app\controllers\EntityAccountController',
        'sp_list' => 'app\controllers\ProductController',
        'hd_list' => 'app\controllers\ActivitieController',
        'mdt_list' => 'app\controllers\MaDuToanController',
        'common_list' => 'app\controllers\CommonlistController',
        'user-services' => 'app\controllers\UserServiceController',
    ],
    'modules' => [
        'actionlog' => [
            'class' => 'cakebake\actionlog\Module',
        ],
    ],
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
                    'returnUrl' => $protocol.$_SERVER['HTTP_HOST'].'/site/auth?authclient=google'
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
 
                'username' => 'listmaster@topica.asia',
                'password' => 'befyssucwbdclscf',
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
                    'controller' => 'pt_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'sp_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'hd_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST search' => 'search'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'cdt_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST search' => 'search',
                        'GET nested' => 'nested'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'mdt_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'POST search' => 'search',
                        'GET nested' => 'nested'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'common_list',
                    'only' => ['index', 'view', 'options', 'search'],
                    'pluralize'=>false,
                    'extraPatterns' => [
                        'GET nested' => 'nested',
                        'GET <slug>' => 'index',
                        'POST <slug>/search' => 'search',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'user-service',
                    'only' => ['login', 'send-mail'],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST send-mail' => 'send-mail'
                    ],
                ],
                '' => '/site/index',
                '<controller:\w+>' => '<controller>/index',
                '<controller>/<action>' => '<controller>/<action>',
                '<action:\w+>' => 'user/<action>', // <-- use UserController by default
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
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
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//        // uncomment the following to add your IP if you are not connecting from localhost.
//        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
