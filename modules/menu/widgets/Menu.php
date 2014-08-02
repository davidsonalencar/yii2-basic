<?php

namespace app\modules\menu\widgets;

use Yii;
use app\modules\menu\helpers\Menu as MenuHelper;

/**
 * Description of Menu
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class Menu extends \yii\bootstrap\Nav {
    
    public function run() {
        
        $this->options['class'] .= ' navbar-nav navbar-right';
        
        $this->items = MenuHelper::getItems();
        
        parent::run();
    }
    
}
