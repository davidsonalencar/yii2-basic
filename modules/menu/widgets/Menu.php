<?php

namespace app\modules\menu\widgets;

use Yii;
use app\modules\menu\components\MenuHelper;

/**
 * Description of Menu
 *
 * @author Davidson
 */
class Menu extends \yii\bootstrap\Nav {
    
    public function run() {
        
        $this->options['class'] .= ' navbar-nav navbar-right';
        
        $this->items = MenuHelper::getMenu();
        
        parent::run();
    }
    
}
