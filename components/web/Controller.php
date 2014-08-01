<?php

namespace app\components\web;

use Yii;
use app\components\filters\AccessControl;

class Controller extends \yii\web\Controller {

    public $menuItens = [];

    public function init() {

        Yii::$app->language = 'pt-BR';

        // Se tiver deslogado
        if (Yii::$app->user->isGuest) {
            $this->menuItens[] = [
                'label' => 'Login',
                'url' => [Yii::$app->user->loginUrl]
            ];
        }
        // Se tiver logado
        else {

            // Retorna extrutura em array para ser utilizado no menu
            $this->menuItens = Yii::$app->user->identity->getMenu();

            // Adiciona botão logout
            $this->menuItens[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
                'url' => ['user/account/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
            ]
        ];
    }

}
