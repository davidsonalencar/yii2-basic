<?php

namespace app\modules\main\forms;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SearchForm extends Model {

    public $nome;
    
    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // nome is required
            [['nome'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'nome' => Yii::t('app', 'Find a user...'),
        ];
    }
    
}
