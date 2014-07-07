<?php

namespace app\components\yii\web;

use Yii;
use app\components\yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \yii\web\Controller {
    
    public $menuItens = [];
    
    public function init(){
        
        Yii::$app->language = 'pt-BR';
        
        // Se tiver deslogado
        if (Yii::$app->user->isGuest) {
            $this->menuItens[] = [
                'label' => 'Login', 
                'url' => ['/site/login']
            ];
        } 
        // Se tiver logado
        else {
            
            // Retorna extrutura em array para ser utilizado no menu
            $this->menuItens = Yii::$app->user->identity->getMenu();
            
            // Adiciona botão logout
            $this->menuItens[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
             
        }
       
        parent::init();
        
    }
    
    /**
     * Retorna o controle de accesso customizado para aplicação
     * 
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return \app\components\yii\filters\AccessControl
     */
    public function getAccessControl($config = array()) {
        
        return new AccessControl($config);
    }
 
    /**
     * Centraliza a class de verbs
     * 
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return \yii\filters\VerbFilter
     */
    public function getVerbFilter($config = array()){
        
        return new VerbFilter($config);
    }
    
}