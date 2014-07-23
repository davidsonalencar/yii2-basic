<?php

namespace app\components\yii\filters;

use Yii;

class AccessControl extends \yii\filters\AccessControl {

    /**
     * @inheritdoc
     */
    public function init() {
        
        $this->initRules();
                  
        parent::init();
    }
    
    /**
     * Inicializa rules, para controle de acesso as páginas.
     * A propriedade $roles receberá a rota da página (ex.: site/index) para 
     * verificar se tem permissão de acessa-la.
     * Essa checagem está sendo verificasa junto a classe app\components\yii\rbac\DbManager
     * e a classe yii\filters\AccessRule.
     */
    private function initRules() {
        
        $this->rules[] = [
            'allow' => true,
            'roles' => [
                Yii::$app->controller->getRoute(),
            ]
        ];
        
    }
    
}