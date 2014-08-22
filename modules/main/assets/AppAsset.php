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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //variables
        //mixins
        //scaffolding
        //helpers
        //layout
        //menus.dropdowns
        //widgets
        //forms
        //buttons
        //labels
        //animations
        //animate.css
        //flotcharts (rever)
        //tooltips
        //menus.navbar.common
        //menus.navbar.default
        //menus.navbar.primary
        //menus.sidebar.less
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\FontRobotoAsset',
        'app\assets\FontOpenSansAsset',
    ];
}
