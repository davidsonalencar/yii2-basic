<?php

namespace app\components\rbac;

use Yii;
use yii\web\Session;
use yii\di\Instance;

/**
 * DbManager represents an authorization manager that stores authorization information in database.
 *
 * The database connection is specified by [[db]]. The database schema could be initialized by applying migration:
 *
 * ```
 * yii migrate --migrationPath=@yii/rbac/migrations/
 * ```
 *
 * If you don't want to use migration and need SQL instead, files for all databases are in migrations directory.
 *
 * You may change the names of the three tables used to store the authorization data by setting [[itemTable]],
 * [[itemChildTable]] and [[assignmentTable]].
 *
 * @author Davidson Alencar <davidson@alencar.com>
 * @since 2.0
 */
class DbManager extends \yii\rbac\DbManager {

    /**
     * @var Session the cache used to improve RBAC performance. This can be one of the followings:
     * 
     * When this is not set, it means caching is not enabled.
     *
     * Note that by enabling RBAC session, all auth items of the user authenticate will be cached and loaded into memory. 
     * This will improve the performance of RBAC permission check. However, it does require extra memory and 
     * as a result may not be appropriate if your RBAC system contains too many auth items. You should seek 
     * other RBAC implementations (e.g. RBAC based on Redis storage) in this case.
     * 
     * Also note that if you modify RBAC items, rules or parent-child relationships from outside of this component,
     * you have to manually call [[invalidateCache()]] to ensure data consistency.
     *
     * @since 2.0.3
     */
    public $session;    
    
    /**
     * @var string the key used to store RBAC data in session
     * @see session
     * @since 2.0.3
     */
    public $sessionKey = 'rbac';
    
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if ($this->session !== null) {
            $this->session = Instance::ensure($this->session, Session::className());
        }
    }
    
    /**
     * @inheritdoc
     */
    public function getAssignments($userId) {
        $assignments = [];
        
        if (empty($userId))
            return [];
        
        if ($this->session !== null && 
            ($assignments = $this->session->get($this->sessionKey)) !== null) {
            return $assignments;
        }
        
        $assignments = parent::getAssignments($userId);
        
        if ($this->session !== null) {
            $this->session->set($this->sessionKey, $assignments);
        }
        
        return $assignments;
    }
    
    public function invalidateCache() {
        parent::invalidateCache();
        if ($this->session !== null) {
            $this->session->set($this->sessionKey, null);
        }
    }

}
