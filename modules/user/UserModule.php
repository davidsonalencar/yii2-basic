<?php

namespace app\modules\user;

use Yii;

class UserModule extends \yii\base\Module {

    /**
     * Namespace do controlados do modulo
     * @var string
     */
    public $controllerNamespace = 'app\modules\user\controllers';
    
    /**
     * Para ser utilizado nos logs
     * @example 
     *    \Yii::info( 'usuario logado', UserModule::$logCategory );
     * @link http://www.yiiframework.com/doc-2.0/guide-logging.html
     * @var string
     */
    public static $logCategory = 'application.modules.user';

    /**
     * Inicialização
     */
    public function init() {
        parent::init();
             
        // custom initialization code goes here
    }

}
