<?php

/**
 * Configuration file for the "yii asset" console command.
 */
// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@vendor', realpath(__DIR__ . '/../vendor'));
Yii::setAlias('@webroot', realpath(__DIR__ . '/../web'));
Yii::setAlias('@web', '/');
return [
    // Adjust command/callback for JavaScript files compressing:
    'jsCompressor' => 'java -jar ' . realpath(__DIR__ . '/../vendor') . '/contempory/closure-compiler/compiler.jar --js {from} --js_output_file {to}',
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => 'java -jar ' . realpath(__DIR__ . '/../vendor') . '/contempory/yuicompressor/yuicompressor.jar --type css {from} -o {to}',
    // The list of asset bundles to compress:
    'bundles' => [
        'app\modules\main\assets\AppAsset',
        //'yii\web\YiiAsset',
        //'yii\web\JqueryAsset',
    ],
    // Asset bundle for compression output:
    'targets' => [
        'app\assets\AllAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
    ],
];
