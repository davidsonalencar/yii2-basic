<?php

$config = [
    // Nome do aplicativo
    'name' => 'My Company',
    // Identificador
    'id' => 'basic',
    // Idioma padrão
    'language' => 'pt-BR',
    // Diretório base do aplicativo
    'basePath' => dirname(__DIR__),
    // Fuso horário
    'timezone' => 'America/Sao_Paulo',
    // Nome do layout padrão
    'layout' => 'main',
    // Local do layout padrão
    'layoutPath' => '@app/modules/main/views/layouts',    
    // Registro dos componentes
    'components' => require(__DIR__ . '/components.php'),
    // Parâmetros
    'params' => require(__DIR__ . '/params.php'),
    // Módulos/Componentes que serão executados em cada requisição
    'bootstrap' => ['log'],
    // Registro dos módulos
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\UserModule',
        ],
        'main' => [
            'class' => 'app\modules\main\MainModule',
        ],
    ],
    // Implementa controle de acesso em todos os controllers
    'as access' => [
        'class' => 'app\components\filters\AccessControl',
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] =  [
        'class' => 'yii\gii\Module',      
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],  
//        'generators' => [ 
//            'controller' => [
//                'class' => 'app\components\gii\generators\controller\Generator', //class generator
//                //'templates' => [ //setting for out templates
//                //    'controllerAuth' => '@app/components/gii/generators/controller/default', //name template => path to template
//                //]                
//            ],
//            //'crud' => [],
//            //'extension' => [],
//            //'form' => [],
//            //'model' => [],
//            //'module' => [],
//        ],
    ];
}

return $config;
