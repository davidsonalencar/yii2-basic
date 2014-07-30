<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Davidson
 */
class Menu extends \yii\bootstrap\Nav {
    
    public function run() {
        
        $this->options = ['class' => 'navbar-nav navbar-right'];
        
        $this->items = Yii::$app->controller->menuItens;
        
        parent::run();
    }
    
}
