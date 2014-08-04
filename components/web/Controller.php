<?php

namespace app\components\web;

use app\components\filters\AccessControl;

class Controller extends \yii\web\Controller {

    /**
     * Layout default
     * @var string
     */
    public $layout = '\main';
    
    /**
     * @inheritdoc
     */
    public function behaviors() {

        return [
            'access' => [
                'class' => AccessControl::className(),
            ]
        ];
    }

}
