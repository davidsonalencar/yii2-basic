<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\modules\main\widgets\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\main\assets\AppAsset;
use app\modules\main\widgets\NavSearch;
//use app\modules\main\widgets\IconButton;
use app\modules\main\widgets\NavNotification;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$this->params['class-css-footer'] = '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>        
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        
        <?php
        
        // INICIO - TOP NAVBAR
        NavBar::begin();
            
            // INICIO - LEFT NAV
            $nav = Nav::begin([
                'options' => [
                    'class' => 'nav navbar-nav navbar-left hidden-xs',  
                ],
            ]);
                
                // SEARCH NAV
                $nav->items[] = Html::tag('li', NavSearch::widget(), [
                    'class' => 'hidden-xs' 
                ]);

                // TERAFAS PENDENTES NAV
                
                // NOTIFICATION NAV
                $nav->items[] = Html::tag('li', NavNotification::widget(), [
                    'class' => 'dropdown notification',
                ]);

                /*$nav->items[] = Html::tag('li', IconButton::widget([
                    'iconCss' => 'fa fa-fw fa-exclamation-circle',
                    'badgeCount' => 2,
                    'dropdown' => [
                        'items' => [
                            ['label' => 'DropdownA', 'url' => '/'],
                            ['label' => 'DropdownB', 'url' => '#'],
                        ],
                    ],
                ]), [
                    'class' => 'dropdown notification',
                ]);*/
                
            // FIM - LEFT NAV
            Nav::end();
            
            // INICIO - RIGHT NAV
            $nav = Nav::begin([
                'options' => [
                    'class' => 'nav navbar-nav pull-right',  
                ],
            ]);
            /*
                $nav->items[] = Html::tag('li', IconButton::widget([
                    'label' => '<img class="img-circle" alt="" src="http://cdn.mosaicpro.biz/flatplus/php/assets/images/people/35/8.jpg"> Davidson Alencar',
                    'showCaret' => true,
                    'dropdown' => [
                        'items' => [
                            ['iconCss' => 'fa fa-user', 'label' => 'Your Profile', 'url' => '#1'],
                            ['iconCss' => 'fa fa-pencil', 'label' => 'Edit Account', 'url' => '#2'],
                            ['iconCss' => 'fa fa-question-circle', 'label' => 'Get Help', 'url' => '#3'],
                            ['iconCss' => 'fa fa-sign-out ', 'label' => 'Logout', 'url' => '#4'],
                        ],
                    ],
                ]), [
                    'class' => 'user',
                ]);
                
                $nav->items[] = Html::tag('li', IconButton::widget([
                    'iconCss' => 'flag-icon flag-icon-us',
                    'dropdown' => [
                        'options' => [
                            'class' => 'dropdown-language',
                        ],
                        'items' => [
                            ['iconCss' => 'flag-icon flag-icon-br', 'url' => '/'],
                            ['iconCss' => 'flag-icon flag-icon-es', 'url' => '#'],
                        ],
                    ],
                ]), [
                    'class' => 'dropdown notification',
                ]);
                */
                $nav->items[] = Html::tag('li', 
                    Html::tag('a', '<i class="fa fa-sign-out"></i>', [
                        'class' => 'menu-icon',
                        'title' => 'Sair',
                        'href' => 'logout',
                        'data-method' => 'post',
                    ])
                );                
            
            // FIM - RIGHT NAV
            Nav::end();            
            
        // FIM - TOP NAVBAR
        NavBar::end();
        ?>
        
        <div id="menu" class="hidden-print hidden-xs">
            <div class="sidebar sidebar-default">
                <div class="sidebar-menu-wrapper">
                    <?= app\modules\menu\widgets\Menu::widget() ?>
                </div>
            </div>
        </div>
        
        <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= $content ?>
        </div>
        

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
        
    </body>
</html>
<?php $this->endPage() ?>
