<?php

$params = require(__DIR__ . '/params.php');
$components = require(__DIR__ . '/components.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'timezone' => 'America/Sao_Paulo',
    'components' => $components,
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] =  [
        'class' => 'yii\gii\Module',      
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],  
        'generators' => [ 
            'controller' => [
                'class' => 'app\components\gii\generators\controller\Generator', //class generator
                //'templates' => [ //setting for out templates
                //    'controllerAuth' => '@app/components/gii/generators/controller/default', //name template => path to template
                //]                
            ],
            //'crud' => [],
            //'extension' => [],
            //'form' => [],
            //'model' => [],
            //'module' => [],
        ],
    ];
}

return $config;
