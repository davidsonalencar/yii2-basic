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
 * @since v4.1.0
 * @version v4.1.0
 */
class FontOpenSansAsset extends AssetBundle {

    public $sourcePath = '@vendor/bower/open-sans-fontface';
    public $css = [
        'open-sans.css',
    ];

}
