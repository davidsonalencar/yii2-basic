<?php

namespace app\components\yii2\web;

use Yii;
use app\models\Operador;

class Controller extends \yii\web\Controller {
    
    public $menuItens = [];
    
    public function init(){
        
        if (Yii::$app->user->isGuest) {
            $this->menuItens[] = [
                'label' => 'Login', 
                'url' => ['/site/login']
            ];
        } else {
            
            $operador = Operador::findIdentity( Yii::$app->user->getId() );

            foreach ($operador->direitos as $direito) {
                $this->menuItens[] = [
                    'label' => $direito->label,
                    'url' => [$direito->url]
                ];
            }            
            
            $this->menuItens[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        
        /*
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
        */
        parent::init();
        
    }
    
}