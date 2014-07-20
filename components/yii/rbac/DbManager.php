<?php

namespace app\components\yii\rbac;

use Yii;

/**
 * @inheritdoc
 */
class DbManager extends \yii\rbac\DbManager {

    /**
     * @inheritdoc
     */
    public function checkAccessRecursive($user, $itemName, $params, $assignments) {
        
        // Permite que a página de erro seja acessivel sem direito
        if ($itemName === Yii::$app->errorHandler->errorAction) {
            return true;
        }
        
        return parent::checkAccessRecursive($user, $itemName, $params, $assignments);
        
    }
    
}
