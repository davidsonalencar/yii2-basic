<?php

return [
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '<action:(index|about)>' => 'main/default/<action>',
            '<action:(login|logout)>' => 'user/account/<action>',
            '' => 'main/default/index',
        ]
    ],
    'authManager' => [
        'class' => 'app\components\rbac\DbManager',
    ],
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'enableCookieValidation' => true,
        'enableCsrfValidation' => true,
        'cookieValidationKey' => 'c5eec1dc0b0c568db4fc2956614925bd',
    ],
    'cache' => [
        'class' => 'app\components\caching\SessionCache',
    ],
    'user' => [
        'class' => 'app\components\web\User',
        'identityClass' => 'app\models\Operador',
        'enableAutoLogin' => true,
        'loginUrl' => 'login',
    ],
    'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
        ],
    ],
    'errorHandler' => [
        'errorAction' => 'main/default/error',
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
];