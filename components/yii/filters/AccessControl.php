<?php

namespace app\components\yii\filters;

use Yii;
use yii\helpers\ArrayHelper;

class AccessControl extends \yii\filters\AccessControl {

    function init() {
                
        $actions = [];
        
        // Pega as ações permitidas para um controller de um determinado module
        if (!Yii::$app->user->isGuest) {
            $actions = Yii::$app->user->identity->getAcoes( Yii::$app->controller->module->id, Yii::$app->controller->id );
        }
        
        // Ações que não serão aplicadas das regras abaixo
        $this->except = ArrayHelper::merge($this->except, ['login', 'logout']);
        
        // Faz com que todas as ações sejam acessadas somente com o usuário logado (@)
        // ['?'] = usuarios deslogados
        // ['@'] = usuarios logados
        $this->rules[] = [
            'actions' => $actions,
            'allow' => true,
            'roles' => ['@'],
        ];
        
        /*$this->rules[] = [
            'roles' => [
                Yii::$app->controller->getRoute()
            ]
        ];*/
                  
        parent::init();
    }
    
}