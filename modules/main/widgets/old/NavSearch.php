<?php
/**
 * @link http://www.github.com/davidsonalencar/yii2-basic
 * @copyright Copyright (c) 2014 Davidson Alencar
 * @license https://github.com/davidsonalencar/yii2-basic/blob/master/LICENCE.md
 */

namespace app\modules\main\widgets;

use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\main\forms\SearchForm;
use Yii;

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
class NavSearch extends Widget {
    
    public function init() {
        parent::init();
    }
    
    public function run() {
        parent::run();
        
        $model = new SearchForm();
        
        $form = ActiveForm::begin([
            'id' => 'search-form',
            'options' => ['class' => 'navbar-form navbar-left'],
            'fieldConfig' => [
                'template' => "{input}",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);

        echo Html::beginTag('div', [
           'class' => 'input-group' 
        ]);

            echo $form->field($model, 'nome', [
                'inputTemplate' => '{input}',
                'inputOptions' => [
                    'placeholder' => Yii::t('app', 'Find a user...'),
                    'autofocus' => '',
                ]
            ]);

            echo Html::beginTag('div', [
                'class' => 'input-group-btn' 
            ]);

                echo Html::submitButton('<i class="fa fa-search"></i>', [
                    'class' => 'btn btn-inverse', 
                    'name' => 'login-button'
                ]);

            echo Html::endTag('div');

        echo Html::endTag('div');

        ActiveForm::end();

    }
    
}