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
class LoginAsset extends AssetBundle {

    public $sourcePath = '@app/modules/main/assets';
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $baseImg = '@web/imgs';
    public $css = [
        'less/login.less',
    ];
    public $js = [
        'js/views.layout.login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AnimateCssAsset',
        'app\assets\AnimateDelayCssAsset',
    ];

}
