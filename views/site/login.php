<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
?>
<div class="login-panel">
    
    <?= Html::img('img/logo.png', [
        'class' => 'logo center-block animate-0_0 bounceIn'
    ]) ?>
    
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username', [
        'inputOptions' => [
            'placeholder' => Yii::t('app', 'Username'),
            'class' => 'form-control animate-0_2 bounceIn',
            'autofocus' => '',
        ]
    ]) ?>

    <?= $form->field($model, 'password', [
        'inputOptions' => [
            'placeholder' => Yii::t('app', 'Password'),
            'class' => 'form-control animate-0_4 bounceIn'
        ]
    ])->passwordInput() ?>
    
    <div class="form-group">
        <div class="col-lg-12">
            <?= Html::submitButton(Yii::t('app', 'Login'), [
                'class' => 'btn btn-lg btn-primary btn-block animate-0_6 bounceIn', 
                'name' => 'login-button'
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
        'options' => [
            'class' => 'form-group animate-0_8 bounceIn'
        ],
    ])->checkbox() ?>

    <?php ActiveForm::end(); ?>

</div>
