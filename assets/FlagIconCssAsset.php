<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 3.2.0
 * @version 3.2.0
 */
class FlagIconCssAsset extends AssetBundle {

    public $sourcePath = '@vendor/bower/flag-icon-css';
    public $css = [
        'less/flag-icon.less',
    ];

}
