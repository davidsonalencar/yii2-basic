<?php
/**
 * @link http://www.github.com/davidsonalencar/yii2-basic
 * @copyright Copyright (c) 2014 Davidson Alencar
 * @license https://github.com/davidsonalencar/yii2-basic/blob/master/LICENCE.md
 */

namespace app\modules\main\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Dropdown renders a Bootstrap dropdown menu component.
 *
 * @see http://getbootstrap.com/javascript/#dropdowns
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class Dropdown extends \yii\bootstrap\Dropdown {

    /**
     * @var string Icon Css
     */
    public $iconCss = '';
    
    /**
     * @var string Icon template
     */
    public $iconTemplate = '<i class="{icon_css}"></i>';
    
    /**
     * Renders menu items.
     * @param array $items the menu items to be rendered
     * @param array $options the container HTML attributes
     * @return string the rendering result.
     * @throws InvalidConfigException if the label option is not specified in one of the items.
     */
    protected function renderItems($items, $options = []) {
        
        $lines = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            
            if (!isset($item['label']) && !isset($item['iconCss'])) {
                throw new InvalidConfigException("The 'label' option or 'iconCss' option is required.");
            }
            
            // Label
            $label = '';
            if (isset($item['label'])) {
                $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
                $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            } 
            
            // Icon CSS
            $icon = '';
            if (isset($item['iconCss'])) {
                $icon = strtr($this->iconTemplate, [
                    '{icon_css}' => $item['iconCss'],
                ]);
            }
            $label = trim($icon . ' ' . $label);
            
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if (empty($item['items'])) {
                if ($url === null) {
                    $content = $label;
                    Html::addCssClass($itemOptions, 'dropdown-header');
                } else {
                    $content = Html::a($label, $url, $linkOptions);
                }
            } else {
                $submenuOptions = $options;
                unset($submenuOptions['id']);
                $content = Html::a($label, $url === null ? '#' : $url, $linkOptions)
                    . $this->renderItems($item['items'], $submenuOptions);
                Html::addCssClass($itemOptions, 'dropdown-submenu');
            }

            $lines[] = Html::tag('li', $content, $itemOptions);
        }

        return Html::tag('ul', implode("\n", $lines), $options);
    }

}
