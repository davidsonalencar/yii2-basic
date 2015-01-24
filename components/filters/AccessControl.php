<?php

namespace app\components\filters;

use Yii;

class AccessControl extends \yii\filters\AccessControl {


    /**
     * Inicializa rules, para controle de acesso as páginas.
     * A propriedade $roles receberá a rota da página (ex.: site/index) para 
     * verificar se tem permissão de acessa-la.
     * Essa checagem está sendo verificasa junto a classe app\components\rbac\DbManager
     * e a classe yii\filters\AccessRule.
     */

    public function beforeAction($action) {
        
        // Obtém a rota atual e verifica junto ao banco de dados se permite ou não
        $this->rules[] = [
            'allow' => true,
            'roles' => [
                Yii::$app->controller->getRoute(),
            ]
        ];
        
        // Permite a ação de error desde que esteja logado.
        // Quando deslogado será redirecionado para a tela de login
        $this->rules[] = [
            'allow' => true,
            'actions' => ['error'],
            'roles' => ['@'],
        ];
        
        // Permite a ação logout desde que esteja logado
        $this->rules[] = [
            'allow' => true,
            'actions' => ['logout'],
            'roles' => ['@'],
        ];
        
        // Permite a ação login desde que esteja deslogado
        $this->rules[] = [
            'allow' => true,
            'actions' => ['login'],
            'roles' => ['?'],
        ];
        
        // Inicializa as rules
        $this->init();        
        
        // Executa o beforeAction da classe pai
        return parent::beforeAction($action);
    }

}
