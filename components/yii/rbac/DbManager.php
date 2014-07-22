<?php

namespace app\components\yii\rbac;

use Yii;
use yii\helpers\ArrayHelper;

class DbManager extends \yii\rbac\DbManager {

    /**
     * @var integer Lifetime of cached data in seconds
     */
    public $cacheDuration = 3600;

    /**
     * @var string cache key name
     */
    public $cacheKeyName = 'RbacCached';

    /**
     * @var array php cache
     */
    protected $cachedData = [];

    /**
     * @inheritdoc
     */
    public function checkAccess($userId, $permissionName, $params = []) {
        
        if (!empty($params))
            return parent::checkAccess($userId, $permissionName, $params);

        $cacheKey = 'checkAccess:' . $userId . ':' . $permissionName;
        $cached = $this->getCache($cacheKey);
        if (empty($cached)) {
            $cached = parent::checkAccess($userId, $permissionName);
            $this->setCache($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * @inheritdoc
     */
    protected function checkAccessRecursive($user, $itemName, $params, $assignments) {
        $cacheKey = 'checkAccessRecursive:' . $user . ':' . $itemName;
        if (!empty($params))
            $cacheKey .= ':' . current($params)->primaryKey;

        $cached = $this->getCache($cacheKey);
        if (empty($cached)) {
            $cached = parent::checkAccessRecursive($user, $itemName, $params, $assignments);
            $this->setCache($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * @inheritdoc
     */
    protected function getItem($name) {
        $cacheKey = 'Item:' . $name;
        $cached = $this->getCache($cacheKey);
        if (empty($cached)) {
            $cached = parent::getItem($name);
            $this->setCache($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * @inheritdoc
     */
    public function getAssignments($userId) {
        if (empty($userId))
            return parent::getAssignments($userId);

        $cacheKey = 'Assignments:' . $userId;
        $cached = $this->getCache($cacheKey);
        if (empty($cached)) {
            $cached = parent::getAssignments($userId);
            $this->setCache($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * Set a value in cache
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function setCache($key, $value) {
        $this->cachedData = $this->getCacheComponent()->get($this->cacheKeyName);
        if (empty($this->cachedData))
            $this->cachedData = [];
        $this->cachedData[$key] = $value;
        return $this->getCacheComponent()->set($this->cacheKeyName, $this->cachedData, $this->cacheDuration);
    }

    /**
     * Get cached value
     * @param $key
     * @return mixed
     */
    protected function getCache($key) {
        $cached = ArrayHelper::getValue($this->cachedData, $key);
        if (!isset($cached)) {
            $cacheData = $this->getCacheComponent()->get($this->cacheKeyName);
            $cached = $this->cachedData[$key] = ArrayHelper::getValue($cacheData, $key);
        }
        return $cached;
    }

    /**
     * Returns cache component configured as in cacheId
     * @return Cache
     */
    protected function getCacheComponent() {
        return Yii::$app->getCache();
    }

}
