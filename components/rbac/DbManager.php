<?php

namespace app\components\rbac;

use Yii;

class DbManager extends \yii\rbac\DbManager {

    /**
     * @inheritdoc
     */
    public function checkAccess($userId, $permissionName, $params = []) {
        
        if (!empty($params))
            return parent::checkAccess($userId, $permissionName, $params);

        $cacheKey = 'checkAccess:' . $userId . ':' . $permissionName;
        $cached = $this->resolveCache()->get($cacheKey);
        if (!isset($cached)) {
            $cached = parent::checkAccess($userId, $permissionName);
            $this->resolveCache()->set($cacheKey, $cached);
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

        $cached = $this->resolveCache()->get($cacheKey);
        if (empty($cached)) {
            $cached = parent::checkAccessRecursive($user, $itemName, $params, $assignments);
            $this->resolveCache()->set($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * @inheritdoc
     */
    protected function getItem($name) {
        $cacheKey = 'Item:' . $name;
        $cached = $this->resolveCache()->get($cacheKey);
        if (empty($cached)) {
            $cached = parent::getItem($name);
            $this->resolveCache()->set($cacheKey, $cached);
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
        $cached = $this->resolveCache()->get($cacheKey);
        if (empty($cached)) {
            $cached = parent::getAssignments($userId);
            $this->resolveCache()->set($cacheKey, $cached);
        }
        return $cached;
    }

    /**
     * Returns cache component configured as in cacheId
     * @return \app\components\caching\SessionCache
     */
    protected function resolveCache() {
        return Yii::$app->getCache();
    }

}
