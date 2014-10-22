<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ButtonDropdown;
use app\modules\main\assets\AppAsset;
use app\modules\main\widgets\SearchNavbar;
use app\modules\main\widgets\NotificationDropdown;

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
            
            $nav = Nav::begin([
                'options' => [
                    'class' => 'nav navbar-nav navbar-left hidden-xs',  
                ],
            ]);
            
            $nav->items[] = SearchNavbar::widget();
            
            $nav->items[] = NotificationDropdown::widget([
                'iconCss' => 'fa fa-fw fa-envelope-o',
                'badgeCount' => 3,
                'dropdown' => [
                    'items' => [
                        ['label' => 'DropdownA', 'url' => '/'],
                        ['label' => 'DropdownB', 'url' => '#'],
                    ],
                ],
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
