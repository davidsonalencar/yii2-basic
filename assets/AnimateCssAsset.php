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
 * @since 2.0
 */
class AnimateCssAsset extends AssetBundle {

    public $sourcePath = '@vendor/contempory/animate.css';
    public $css = [
        'animate.min.css',
    ];

}
