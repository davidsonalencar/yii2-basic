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

        //$this->options['class'] .= ' navbar-nav navbar-right';

        $this->items = MenuHelper::getItems();

        parent::run();
    }

    /**
     * Renders widget items.
     */
    public function renderItems() {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

}
