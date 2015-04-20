<?php

namespace app\modules\main\widgets;

use yii\bootstrap\Nav;
use yii\widgets\Menu;
use \yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\modules\main\assets\SideNavAsset;
use yii\helpers\Url;

class SideNav extends Menu {

    /**
     * @var string the template used to render a list of sub-menus.
     * In this template, the token `{items}` will be replaced with the rendered sub-menu items.
     */
    public $submenuTemplate = "\n<ul class=\"nav\">\n{items}\n</ul>\n";

    /**
     * @var string the template used to render the body of a menu which is a link.
     * In this template, the token `{url}` will be replaced with the corresponding link URL;
     * while `{label}` will be replaced with the link text.
     * This property will be overridden by the `template` option set in individual menu items via [[items]].
     */
    public $linkTemplate = '<a href="{url}">{icon}{label}</a>';

    /**
     * @var string the template used to render the body of a menu which is NOT a link.
     * In this template, the token `{label}` will be replaced with the label of the menu item.
     * This property will be overridden by the `template` option set in individual menu items via [[items]].
     */
    public $labelTemplate = '{icon}{label}';

    /**
     * @var boolean whether to activate parent menu items when one of the corresponding child menu items is active.
     * The activated parent menu items will also have its CSS classes appended with [[activeCssClass]].
     */
    public $activateParents = true;

    /**
     * @var string prefix for the icon in [[items]]. This string will be prepended
     * before the icon name to get the icon CSS class. This defaults to `glyphicon glyphicon-`
     * for usage with glyphicons available with Bootstrap.
     */
    public $iconPrefix = 'fa fa-';

    /**
     * @var string indicator for a menu sub-item
     */
    public $indItem = '- ';    
    
    /**
     * @var string indicator for a opened sub-menu
     */
    public $indClassShown = 'chevron-down';

    /**
     * @var string indicator for a closed sub-menu
     */
    public $indClassHidden = 'chevron-right';
    
    /**
     * @var string indicator for a both sub-menu
     */
    public $indClass = 'indicator';

    /**
     * @var string the CSS class to be appended to the active menu item.
     */
    public $activeCssClass = 'active-link';
    
    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init() {
        parent::init();

        $this->options['id'] = $this->getId();
        Html::addCssClass($this->options, 'nav');

        $this->markTopItems();
        
        $this->registerAssets();
    }

    /**
     * Register Assets
     */
    protected function registerAssets() {

        $view = $this->getView();

        SideNavAsset::register($view);

        $view->registerJs("$('#{$this->options['id']}').sidenav();");
    }

    /**
     * Marks each topmost level item which is not a submenu
     */
    protected function markTopItems() {
        $items = [];
        foreach ($this->items as $item) {
            if (empty($item['items'])) {
                $item['top'] = true;
            }
            $items[] = $item;
        }
        $this->items = $items;
    }

    /**
     * Renders the content of a side navigation menu item.
     *
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     * @throws InvalidConfigException
     */
    protected function renderItem($item) {

        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        $url      = Url::to(ArrayHelper::getValue($item, 'url', '#'));

        if (empty($item['top'])) {
            if (empty($item['items'])) {
                $template = str_replace('{icon}', $this->indItem . '{icon}', $template);
            } else {
                //$template  = isset($item['template']) ? $item['template'] : '<a href="{url}" class="da-toggle">{icon}{label}</a>';
                //$options   = ($item['active']) ? ['class' => 'collapse in'] : ['class' => 'collapse'];
                //$indicator = Html::tag('span', $this->indCOpen, $openOptions) . Html::tag('span', $this->indMenuClose, $closeOptions);
                $indicator = Html::tag('i', '', [
                    'class' => $this->indClass . ' ' . ($item['active'] ? $this->iconPrefix.$this->indClassShown : $this->iconPrefix.$this->indClassHidden), 
                    'data-class-shown' => $this->iconPrefix.$this->indClassShown,
                    'data-class-hidden' => $this->iconPrefix.$this->indClassHidden,
                ]);
                $template  = str_replace('{icon}', $indicator . '{icon}', $template);
            }
        }
        $icon = empty($item['icon']) ? '' : '<i class="' . $this->iconPrefix . $item['icon'] . '"></i> &nbsp;';
        unset($item['icon'], $item['top']);
        return strtr($template, [
            '{url}' => $url,
            '{label}' => $item['label'],
            '{icon}' => $icon
        ]);
    }

}
