<?php

namespace app\components\yii2\web;

use Yii;

class Controller extends \yii\web\Controller {
    
    public $menuItens = [];
    
    public function init(){
           
        $this->menuItens = [
            ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
        ];
        
        parent::init();
        
    }
    
}