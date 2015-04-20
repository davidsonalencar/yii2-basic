<?php
use yii\helpers\Html;
use app\modules\main\widgets\NavBar;
use yii\bootstrap\Nav;
use kartik\icons\Icon;

/* @var $this \yii\web\View */
/* @var $content string */

NavBar::begin([
    'brandLabel' => '<span class="logo"/>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-primary',
    ],
]);
    echo Html::beginTag('nav');
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [[
                /**
                * Messages
                */
                'label' => Icon::show('envelope').'<span class="badge">4</span>', 
                'encode' => false,
                'options' => [
                    'class' => 'dropdown-messages hidden-xs hidden-sm'
                ],
                'items' => []
            ], [
                /**
                 * Tarefas
                 */
                'label' => Icon::show('tasks').'<span class="badge">4</span>', 
                'encode' => false,
                'options' => [
                    'class' => 'dropdown-tasks hidden-xs'
                ],
                'items' => []
            ], [
                /**
                 * Alertas
                 */
                'label' => Icon::show('bell').'<span class="badge">4</span>', 
                'encode' => false,
                'options' => [
                    'class' => 'dropdown-alerts hidden-xs'
                ],
                'items' => []
            ], [
                /**
                 * Idiomas
                 */
                'label' => Icon::show('us', [], Icon::FI), 
                'encode' => false,
                'options' => [
                    'class' => 'dropdown-language hidden-xs'
                ],
                'items' => []
            ], [
                /**
                 * Profile
                 */
                'label' => '<img class="img-rounded" alt="" src="http://cdn.mosaicpro.biz/flatplus/php/assets/images/people/35/8.jpg"> '.
                           '<span class="hidden-xs hidden-sm">Davidson Alencar</span>',
                'encode' => false,
                'options' => [
                    'class' => 'dropdown-profile'
                ],
                'items' => []
            ], [
                /**
                 * Fullscreen
                 */
                'label' => '<i class="fa fa-expand"></i>',
                'encode' => false,
                'options' => [
                    'class' => 'hidden-xs hidden-sm'
                ],
            ], [
                /**
                 * Logout
                 */
                'label' => '<i class="fa fa-sign-out"></i>',
                'encode' => false,
            ]],            
        ]);
    echo Html::endTag('nav');
NavBar::end();