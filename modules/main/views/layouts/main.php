<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Button;
use app\modules\main\assets\AppAsset;
use app\modules\main\widgets\SearchNavbar;
use app\modules\main\widgets\IconDropdown;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
        NavBar::begin([
            'brandLabel' => Html::img(Yii::$app->request->baseUrl.'/img/logo.png', [
                'class' => 'logo',
                'alt' => Yii::$app->name,
            ]),
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'class' => 'app-brand',
            ],
            'options' => [
                'class' => 'navbar-fixed-top navbar-primary main',
                'tag' => 'div',
            ],
        ]);
            
            // LEFT NAV
            $nav = Nav::begin([
                'options' => [
                    'class' => 'nav navbar-nav navbar-left hidden-xs',  
                ],
            ]);
            
                $nav->items[] = Html::tag('li', SearchNavbar::widget(), [
                    'class' => 'hidden-xs' 
                ]);
                        
                $nav->items[] = Html::tag('li', IconDropdown::widget([
                    'iconCss' => 'fa fa-fw fa-envelope-o',
                    'badgeCount' => 3,
                    'dropdown' => [
                        'items' => [
                            ['label' => 'DropdownA', 'url' => '/'],
                            ['label' => 'DropdownB', 'url' => '#'],
                        ],
                    ],
                ]), [
                    'class' => 'dropdown notification',
                ]);

                $nav->items[] = Html::tag('li', IconDropdown::widget([
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
                ]);

                $nav->items[] = Html::tag('li', IconDropdown::widget([
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
            
            Nav::end();
            
            // RIGHT NAV
            $nav = Nav::begin([
                'options' => [
                    'class' => 'nav navbar-nav pull-right',  
                ],
            ]);
            
                $nav->items[] = Html::tag('li', IconDropdown::widget([
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
                
                $nav->items[] = Button::widget([
                    'tagName' => 'a',
                    'label' => '',
                ]);

            Nav::end();            
            
        //echo app\modules\menu\widgets\Menu::widget();

        NavBar::end();
        ?>

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
