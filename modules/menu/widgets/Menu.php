<?php

namespace app\modules\menu\widgets;

//use Yii;
use \yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\BootstrapAsset;
use app\modules\menu\helpers\MenuHelper;

/**
 * Description of Menu
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class Menu extends \yii\bootstrap\Nav //\app\modules\main\widgets\Nav 
{

    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    /*public $items = [];
    
    public $itemOptions = [];
    
    public $dataToggle = 'collapse';*/
    
    /**
     * Renders the widget.
     */
    public function run() {

        //$this->options['class'] .= ' navbar-nav navbar-right';

        $this->items = MenuHelper::getItems();
        
        //echo $this->renderItems( $this->items, $this->options );
        
        //BootstrapAsset::register($this->getView());
        
        parent::run();
    }

    /**
     * Renders widget items.
     * @param array $options
     * @return string
     *//*
    public function renderItems($items, $options) {
        $itemsVisible = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($itemsVisible[$i]);
                continue;
            }
            $itemsVisible[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $itemsVisible), $options);
    }*/

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     *//*
    public function renderItem($item) {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        //$encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        //$label       = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $label       = $item['label'];
        $options     = ArrayHelper::getValue($item, 'options', []);
        $items       = ArrayHelper::getValue($item, 'items');
        $url         = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

//        if (isset($item['active'])) {
//            $active = ArrayHelper::remove($item, 'active', false);
//        } else {
//            $active = $this->isItemActive($item);
//        }

        if ($items !== null) {
            $linkOptions['data-toggle'] = $this->dataToggle;
            Html::addCssClass($options, 'hasSubmenu');
            Html::addCssClass($linkOptions, 'collapsed');
            //$label .= ' ' . Html::tag('b', '', ['class' => 'caret']);
            if (is_array($items)) {
//                if ($this->activateItems) {
//                    $items = $this->isChildActive($items, $active);
//                }
                $items = $this->renderItems( $items, $this->itemOptions );
            }
        }

//        if ($this->activateItems && $active) {
//            Html::addCssClass($options, 'active');
//        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
*/
}
