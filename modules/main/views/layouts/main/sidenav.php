<?php

use yii\helpers\Html;
use app\modules\main\widgets\SideNav;
//use kartik\sidenav\SideNav;
//use yii\widgets\Menu;
//use app\modules\menu\widgets\Menu;
use yii\bootstrap\Nav;

/* @var $this \yii\web\View */
/* @var $content string */

echo Html::beginTag('nav', [
    'class' => 'sidenav',
]);

    echo SideNav::widget([
//        'options' => [
//            'class' => 'nav nav-pills nav-stacked',
//        ],
        'items' => [
            // Important: you need to specify url as 'controller/action',
            // not just as 'controller' even if default action is used.
            ['label' => 'Home', 'url' => ['site/index']],
            // 'Products' menu item will be selected as long as the route is 'product/index'
            ['label' => 'Products', 'url' => ['product/index'], 'items' => [
                ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            ]],
            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
        ],
    ]);

//    echo SideNav::widget([
//        'type' => SideNav::TYPE_DEFAULT,
//        'encodeLabels' => false,
//        'heading' => 'Menu',
//        'iconPrefix' => 'fa fa-',
//        'indMenuOpen' => '<i class="indicator fa fa-chevron-down"></i>',
//        'indMenuClose' => '<i class="indicator fa fa-chevron-left"></i>',
//        'items' => [
//            // Important: you need to specify url as 'controller/action',
//            // not just as 'controller' even if default action is used.
//            ['label' => 'Home', 'icon' => 'home', 'url' => ['/site/index']],
//            // 'Products' menu item will be selected as long as the route is 'product/index'
//            ['label' => 'Books', 'icon' => 'book', 'items' => [
//                ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url' => '#'],
//                ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => '#'],
//                ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
//                    ['label' => 'Online 1', 'url' => '#'],
//                    ['label' => 'Online 2', 'url' => '#']
//                ]],
//            ]],
//            ['label' => '<span class="pull-right badge">3</span> Categories', 'icon' => 'tags', 'items' => [
//                ['label' => 'Fiction', 'url' => '#'],
//                ['label' => 'Historical', 'url' => '#'],
//                ['label' => '<span class="pull-right badge">2</span> Announcements', 'icon' => 'bullhorn', 'items' => [
//                    ['label' => 'Event 1', 'url' => '#'],
//                    ['label' => 'Event 2', 'url' => '#']
//                ]],
//            ]],
//            ['label' => 'Profile', 'icon' => 'user', 'url' => '#'],
//        ],
//    ]);
echo Html::endTag('nav');