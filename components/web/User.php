<?php

namespace app\components\web;

use Yii;

class User extends \yii\web\User {

    /**
     * @inheritdoc
     */
    public function can($permissionName, $params = [], $allowCaching = true) {

        if ($permissionName === Yii::$app->errorHandler->errorAction) {
            $access = true;
        } else {
            $access = parent::can($permissionName, $params, $allowCaching);
        }

        return $access;
    }

    /**
     * @inheritdoc
     */
    public function getReturnUrl($defaultUrl = null) {
        
        $route = parent::getReturnUrl($defaultUrl);
        
        /* testar se existe rota */
        
        return $route;
    }

}
