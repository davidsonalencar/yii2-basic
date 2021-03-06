<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\main\assets;

use yii\web\AssetBundle;

/**
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle {

    public $sourcePath = '@app/modules/main/assets';
    public $css = [
        'less/main.less',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'app\assets\FontAwesomeAsset',
        'app\assets\FontRobotoAsset',
        'app\assets\FontOpenSansAsset',
        //'app\assets\FlagIconCssAsset',
    ];

}
