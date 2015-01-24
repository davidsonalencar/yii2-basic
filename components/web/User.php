<?php

namespace app\components\web;

use Yii;

class User extends \yii\web\User {

    /**
     * @inheritdoc
     */
    public function getReturnUrl($defaultUrl = null) {
        
        $route = parent::getReturnUrl($defaultUrl);
        
        /* testar se existe rota */
        
        return $route;
    }

}
