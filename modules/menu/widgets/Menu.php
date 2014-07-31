<?php

namespace app\modules\menu\widgets;

use Yii;

/**
 * Description of Menu
 *
 * @author Davidson
 */
class Menu extends \yii\bootstrap\Nav {
    
    public function run() {
        
        $this->options['class'] .= ' navbar-nav navbar-right';
        
        \yii\helpers\VarDumper::dump(Yii::$app->authManager->getPermissions());
        
        $this->items = Yii::$app->controller->menuItens;
        
        parent::run();
    }
    
}
