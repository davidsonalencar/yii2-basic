<?php

namespace app\components\yii\rbac;

use yii\db\Query;
use yii\rbac\Assignment;
use yii\rbac\Permission;
use yii\rbac\Item;
use Yii;

/**
 * @inheritdoc
 */
class DbManager extends \yii\rbac\DbManager {

    private $direitoTable = 'direito';
    private $operadorGrupoTable = 'operador_grupo';
    private $operadorDireitoTable = 'operador_direito';
    private $grupoDireitoTable = 'grupo_direito';

    /**
     * @inheritdoc
     */
    public function checkAccessRecursive($user, $itemName, $params, $assignments) {
        
        if (($item = $this->getItem($itemName)) === null) {
            return false;
        }

        Yii::trace($item instanceof Role ? "Checking role: $itemName" : "Checking permission: $itemName", __METHOD__);

        if (!$this->executeRule($user, $item, $params)) {
            return false;
        }

        if (isset($assignments[$itemName]) || in_array($itemName, $this->defaultRoles)) {
            return true;
        }

        $query = new Query;
        $parents = $query->select(['dp.url'])
                ->from(['d' => $this->direitoTable, 'dp' => $this->direitoTable])
                ->where('d.id_direito_pai = dp.id_direito')
                ->andWhere(['d.url' => $itemName])
                ->column($this->db);
        foreach ($parents as $parent) {
            if ($this->checkAccessRecursive($user, $parent, $params, $assignments)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    protected function getItem($name) {

        $row = (new Query)
                ->from($this->direitoTable)
                ->where(['url' => $name])
                ->one($this->db);

        if ($row === false) {
            return null;
        }

        return $this->populateItem($row);
    }
    
    /**
     * @inheritdoc
     */
    protected function populateItem($row) {

        return new Permission([
            'name' => $row['url'],
            'type' => Item::TYPE_PERMISSION,
            'description' => $row['label'],
//            'ruleName' => null, //aplicar nome da rule aqui
//            'data' => null,
//            'createdAt' => $row['dt_inc'],
//            'updatedAt' => $row['updated_at'],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function getAssignments($userId) {

        $query = (new Query)
                ->select(['d.url'])
                ->from(['d' => $this->direitoTable, 'od' => $this->operadorDireitoTable])
                ->where('d.id_direito = od.id_direito')
                ->andWhere(['od.id_operador' => $userId]);

        $queryGrupo = (new Query)
                ->select(['d.url'])
                ->from(['d' => $this->direitoTable, 'gd' => $this->grupoDireitoTable, 'og' => $this->operadorGrupoTable])
                ->where('d.id_direito = gd.id_direito')
                ->andWhere('og.id_grupo = gd.id_grupo')
                ->andWhere(['og.id_operador' => $userId]);

        $query->union($queryGrupo);

        $assignments = [];
        foreach ($query->all($this->db) as $row) {

            $assignments[$row['url']] = new Assignment([
                'userId' => $userId,
                'roleName' => $row['url'],
                    //'createdAt' => $row['createdAt'],
            ]);
        }

        return $assignments;
    }
    
}
