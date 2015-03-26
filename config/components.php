<?php

$config = [
    // Gerenciamento de URL
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
    // Gerenciamento de assets
    'assetManager' => [
        'converter' => [
            /*'class' => 'app\components\web\AssetConverter',*/
            'forceConvert' => YII_ENV_DEV,
            //'commands' => [
                //'less' => ['css', '/usr/local/bin/lessc {from} {to} --no-color'],
            //],
        ],
    ],
    // Gerenciamento da requisição
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'enableCookieValidation' => true,
        'enableCsrfValidation' => true,
        'cookieValidationKey' => 'c5eec1dc0b0c568db4fc2956614925bd',
    ],
    // Forma que a aplicação realiza o cache
    'cache' => [
        'class' => 'app\components\caching\SessionCache',
    ],
    // Controle de autenticação
    'user' => [
        'class' => 'app\components\web\User',
        'identityClass' => 'app\models\Operador',
        'enableAutoLogin' => true,
        'loginUrl' => 'login',
    ],
    // Controle de acesso
    'authManager' => [
        'class' => 'app\components\rbac\DbManager',
    ],
    // Internacionalização
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
    // Manipulador de erros
    'errorHandler' => [
        'errorAction' => 'main/default/error',
    ],
    // Gerenciamento de emails
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    // Gerenciamento de log
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    // Conexão com o banco de dados
    'db' => require(__DIR__ . '/db.php'),
];

// Se não estiver no ambiente de desenvolvimento utilizará os arquivos comprimidos e unificados
if (!YII_ENV_DEV) {
    $config['assetManager']['bundles'] = require(__DIR__ . '/assets_compressed.php');
}

return $config;