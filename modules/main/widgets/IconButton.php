<?php
/**
 * @link http://www.github.com/davidsonalencar/yii2-basic
 * @copyright Copyright (c) 2014 Davidson Alencar
 * @license https://github.com/davidsonalencar/yii2-basic/blob/master/LICENCE.md
 */

namespace app\modules\main\widgets;

use yii\helpers\Html;
use app\modules\main\widgets\Dropdown;
use yii\bootstrap\Widget;

/**
 * SearchNavbar renderiza navbar search form.
 *
 * Por exemplo,
 *
 * ```php
 * $nav = Nav::begin();
 *            
 * $nav->items[] = SearchNavbar::widget();
 *
 * Nav::end();
 * ```
 * @see http://getbootstrap.com/components/#navbar-forms
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 201401.1
 */
class IconButton extends Widget {

    /**
     * @var string Icon Css
     */
    public $iconCss = '';
    
    /**
     * @var string Badge class css
     */
    public $badgeCss = 'badge badge-primary';
    
    /**
     * @var string Icon template
     */
    public $iconTemplate = '<i class="{icon_css}"></i>';
    
    /**
     * @var string Badge template
     */
    public $badgeTemplate = '<span class="{badge_css}">{badge_count}</span>';

    /**
     * @var string Label
     */
    public $label = '';
    
    /**
     * @var array the HTML attributes of the button.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the configuration array for [[Dropdown]].
     */
    public $dropdown = [];
    
    /**
     * @var string the tag to use to render the button
     */
    public $tagName = 'a';
    
    /**
     * @var integer Badge count
     */
    public $badgeCount = 0;
    
    /**
     * @var string Caret teplate
     */
    public $caretTemplate = '<span class="caret"></span>';
    
    /**
     * @var boolean Show or hide caret icon
     */
    public $showCaret = false;
    

    /**
     * Renders the widget.
     */
    public function run() {

        echo "\n" . $this->renderIcon();
        echo "\n" . $this->renderDropdown();

    }

    /**
     * Generates the icon dropdown.
     * @return string the rendering result.
     */
    protected function renderIcon() {

        Html::addCssClass($this->options, 'menu-icon dropdown-toggle dropdown-hover');

        $label = $this->label;
        
        $label = trim($label . ' ' . strtr($this->iconTemplate, [
            '{icon_css}' => $this->iconCss,
        ]));
        
        if ($this->badgeCount > 0) {
            $label .= strtr($this->badgeTemplate, [
                '{badge_css}' => $this->badgeCss,
                '{badge_count}' => $this->badgeCount,
            ]);
        }
        
        // Caret Icon
        if ($this->showCaret) {
            $label .= ' <span class="caret"></span>';
        }
        
        $options = $this->options;
        if (!isset($options['href'])) {
            $options['href'] = 'javascript:;';
        }
        $options['data-toggle'] = 'dropdown';

        return Html::tag('a', $label, $options);
    }

    /**
     * Generates the dropdown menu.
     * @return string the rendering result.
     */
    protected function renderDropdown() {
        $config = $this->dropdown;
        $config['clientOptions'] = false;
        $config['view'] = $this->getView();

        return Dropdown::widget($config);
    }

}
