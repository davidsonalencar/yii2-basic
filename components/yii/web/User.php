<?php

namespace app\components\yii\web;

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
    
    protected function beforeLogin($identity, $cookieBased, $duration) {
        parent::beforeLogin($identity, $cookieBased, $duration);
        
        $identity->generateAuthKey();
        
        return true;
    }
   
    /**
     * Retorna dados do usuário gravados em cookie, como id, authKey e duração.
     * Exemplo: [0 => 'id', 1 => 'authKey', 2 => 'duration'] 
     * @return array[]
     */
    public function getCookieIdentity() {
        
        $cookieName = Yii::$app->user->identityCookie['name'];
        
        $value = Yii::$app->getRequest()->getCookies()->getValue( $cookieName );

        if ($value === null) {
            return false;
        }

        $data = json_decode($value, true);
        if (count($data) === 3 && isset($data[0], $data[1], $data[2])) {
           return $data; 
        }
        
        return false;
        
    }
    
}
