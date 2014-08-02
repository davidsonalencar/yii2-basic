<?php

namespace app\modules\menu\widgets;

use app\modules\menu\helpers\Menu as MenuHelper;

/**
 * Description of Menu
 *
 * @author Davidson
 */
class Menu extends \yii\bootstrap\Nav {
    
    public function run() {
        
        $this->options['class'] .= ' navbar-nav navbar-right';
        
        $this->items = MenuHelper::getItems();
        
        parent::run();
    }
    
}
