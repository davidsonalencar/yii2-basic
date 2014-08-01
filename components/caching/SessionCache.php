<?php

namespace app\components\caching;

use Yii;
use yii\helpers\ArrayHelper;

class SessionCache extends \yii\caching\FileCache {

    /**
     * @var array php cache
     */
    protected $cachedData = [];
    
    /**
     * @var string
     */
    private $sessionId;
    
    /**
     * Get session id
     * @return string
     */
    protected function getSessionId() {
        
        if (empty($this->sessionId)) {
            $this->sessionId = Yii::$app->getSession()->getId();
        }
        
        return $this->sessionId;
    }

    /**
     * @inheritdoc
     */
    public function get($key) {
        
        $cached = ArrayHelper::getValue($this->cachedData, $key);
        if (!isset($cached)) {
            $cacheData = parent::get( $this->getSessionId() );
            $cached = $this->cachedData[$key] = ArrayHelper::getValue($cacheData, $key);
        }
        return $cached;
    }
    
    /**
     * @inheritdoc
     */
    public function set($key, $value, $duration = 0, $dependency = null) {
        
        $this->cachedData = parent::get( $this->getSessionId() );
        if (empty($this->cachedData))
            $this->cachedData = [];
        $this->cachedData[$key] = $value;
        return parent::set( $this->getSessionId(), $this->cachedData, $duration, $dependency );
    }
    
}