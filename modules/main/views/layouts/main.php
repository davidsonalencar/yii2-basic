<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use app\modules\main\assets\AppAsset;

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
            
            $nav = Nav::begin();
            
            $this->beginBlock('menu-item-search-user');
            

     $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'navbar-form navbar-left'],
        'fieldConfig' => [
            'template' => "{input}",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);
    ?>
     
    <div class="input-group">
        <?= $form->field(new app\modules\main\forms\SearchForm(), 'nome', [
            'inputTemplate' => '{input}',
            'inputOptions' => [
                'placeholder' => Yii::t('app', 'Find a user...'),
                'autofocus' => '',
            ]
        ]); ?>
        <div class="input-group-btn">
                <?= Html::submitButton('<i class="fa fa-search"></i>', [
                    'class' => 'btn btn-inverse', 
                    'name' => 'login-button'
                ]) ?>
        </div>
    </div>

    <?php ActiveForm::end();
                
            $this->endBlock();
            
            $nav->items[] = $this->blocks['menu-item-search-user'];
            
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
