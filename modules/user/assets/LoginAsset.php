<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\user\assets;

use yii\web\AssetBundle;

/**
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $baseImg = '@web/imgs';
    public $css = [
        'css/login.less',
    ];
    public $js = [
        'js/login.parallax.init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AnimateCssAsset',
        'app\assets\AnimateDelayCssAsset',
    ];

}
