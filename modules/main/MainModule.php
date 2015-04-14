<?php

namespace app\modules\main;

use Yii;
use yii\helpers\ArrayHelper;

class MainModule extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\main\controllers';

    public function init() {
        parent::init();
        
        $this->makeAssetManager();
    }
    
    /**
     * Retiro o yii\bootstrap\BootstrapAsset responsavel por colocar o bootstrap.css
     * pois este módulo personaliza o bootstrap utilizando o bootstrap.less em
     * sua folha de estilo
     */
    private function makeAssetManager() {
        
        $assetManager = Yii::$app->getComponents()['assetManager'];
       
        $assetManager = ArrayHelper::merge($assetManager, [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false
            ]
        ]);
                
        Yii::$app->setComponents([
            'assetManager' => $assetManager
        ]);
        
    }
    
    

}
