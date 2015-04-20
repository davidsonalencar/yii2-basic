<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\main\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Description of NavBar
 *
 * @author Davidson Alencar
 */
class NavBar extends \yii\bootstrap\NavBar {
    
    public static function begin($config = array()) {
        
        $config = [
            'brandLabel' => Html::img(Yii::$app->request->baseUrl.'/img/logo.png', [
                'class' => 'logo',
                'alt' => Yii::$app->name,
            ]),
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'class' => 'app-brand',
            ],
            'options' => [
                'class' => 'navbar-fixed-top navbar-primary main',
                'tag' => 'div',
            ],
        ];
        
        parent::begin($config);
    }
    
}
