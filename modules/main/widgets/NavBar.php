<?php

namespace app\modules\main\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Widget;
use app\modules\main\assets\NavBarAsset;

/**
 * NavBar renders a navbar HTML component.
 *
 * Any content enclosed between the [[begin()]] and [[end()]] calls of NavBar
 * is treated as the content of the navbar. You may use widgets such as [[Nav]]
 * or [[\yii\widgets\Menu]] to build up such content. For example,
 *
 * ```php
 * use yii\bootstrap\NavBar;
 * use yii\widgets\Menu;
 *
 * NavBar::begin(['brandLabel' => 'NavBar Test']);
 * echo Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => ['/site/index']],
 *         ['label' => 'About', 'url' => ['/site/about']],
 *     ],
 * ]);
 * NavBar::end();
 * ```
 *
 * @see http://getbootstrap.com/components/#navbar
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Kochetov <creocoder@gmail.com>
 * @since 2.0
 */
class NavBar extends Widget {

    /**
     * @var array the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "nav", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    //public $containerOptions = [];

    /**
     * @var string|boolean the text of the brand of false if it's not used. Note that this is not HTML-encoded.
     * @see http://getbootstrap.com/components/#navbar
     */
    public $brandLabel = false;

    /**
     * @param array|string|boolean $url the URL for the brand's hyperlink tag. This parameter will be processed by [[Url::to()]]
     * and will be used for the "href" attribute of the brand link. Default value is false that means
     * [[\yii\web\Application::homeUrl]] will be used.
     */
    public $brandUrl = false;

    /**
     * @var array the HTML attributes of the brand link.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $brandOptions = [];

    /**
     * @var string text to show for screen readers for the button to toggle the navbar.
     */
    public $screenReaderToggleText = 'Toggle navigation';

    /**
     * @var boolean whether the navbar content should be included in an inner div container which by default
     * adds left and right padding. Set this to false for a 100% width navbar.
     */
    public $renderInnerContainer = true;

    /**
     * @var array the HTML attributes of the inner container.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $innerContainerOptions = [];

    /**
     * @var string classe aplicada no elemento body ao clicar no navbar-toggle 
     * para mostrar/esconder um menu de navegação quando a página estiver com 
     * resolução menor que xs (768px)  
     */
    public $classToggled = 'sidenav-toggled';
    
    /**
     * @var string classe aplicada no elemento body ao clicar no navbar-toggle 
     * para minimizar/maximizar um menu de navegação quando a página estiver com 
     * resolução maior e igual que xs (768px)  
     */
    public $classCollapsed = 'sidenav-collapsed';
    
    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();

        echo $this->beginNavBar();
               
            echo $this->beginInnerContainer();
            
                echo $this->renderHeader();
        
    }

    /**
     * Renders the widget.
     */
    public function run() {
        
            echo $this->endInnerContainer();
            
        echo $this->endNavBar();
        
        $this->registerAssets();
    }

    /**
     * Register Assets
     */
    protected function registerAssets() {

        $view = $this->getView();

        NavBarAsset::register($view);

        $view->registerJs("$('#{$this->options['id']}').navbar();");
        
    }


    protected function beginNavBar() {
        
        Html::addCssClass($this->options, 'navbar');
        if ($this->options['class'] === 'navbar') {
            Html::addCssClass($this->options, 'navbar-default');
        }
        if (empty($this->options['role'])) {
            $this->options['role'] = 'navigation';
        }
        $options = $this->options;
        $tag     = ArrayHelper::remove($options, 'tag', 'header');
        
        return Html::beginTag($tag, $options);
        
    }
    
    protected function endNavBar() {
        
        $tag = ArrayHelper::remove($this->options, 'tag', 'header');
        echo Html::endTag($tag, $this->options);
        
    }
    
    protected function beginInnerContainer() {
        
        if (!$this->renderInnerContainer) {
            return '';
        } 
        
        if (!isset($this->innerContainerOptions['class'])) {
            Html::addCssClass($this->innerContainerOptions, 'container-fluid');
        }
        
        return Html::beginTag('div', $this->innerContainerOptions);
                
    }
    
    protected function endInnerContainer() {
        
        if (!$this->renderInnerContainer) {
            return '';
        } 
        
        return Html::endTag('div');
        
    }

    protected function renderHeader() {
        
        return   Html::beginTag('div', ['class' => 'navbar-header'])
               . $this->renderToggleButton()
               . $this->renderBrand()
               . Html::endTag('div');
        
    }
        
    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton() {
        
        $bar = Html::tag('span', '', ['class' => 'icon-bar']);
        $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

        return Html::button("{$screenReader}\n{$bar}\n{$bar}\n{$bar}", [
                    'class' => 'navbar-toggle',
                    'data-class-toggled' => $this->classToggled,
                    'data-class-collapsed' => $this->classCollapsed,
        ]);
        
    }
    
    protected function renderBrand() {
        
        if ($this->brandLabel === false) {
            return '';
        }
        
        Html::addCssClass($this->brandOptions, 'navbar-brand');
        return Html::a($this->brandLabel, $this->brandUrl === false ? Yii::$app->homeUrl : $this->brandUrl, $this->brandOptions);
                
    }

}
