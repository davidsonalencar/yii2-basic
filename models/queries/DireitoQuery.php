<?php

namespace app\models\queries;

use app\models\Direito;

/**
 * Description of DireitoQuery
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class DireitoQuery extends \yii\db\ActiveQuery {

    /**
     * Adiciona clausura para retornar somente os direitos de menus
     * @return \app\models\queries\DireitoQuery
     */
    public function menu() {
        
        $this->andWhere(['tipo' => Direito::TIPO_MENU]);
        return $this;
    }
    
    /**
     * Adiciona clausura para retornar somente os direitos de botões
     * @return \app\models\queries\DireitoQuery
     */
    public function botao() {
        
        $this->andWhere(['tipo' => Direito::TIPO_BOTAO]);
        return $this;
    }
    
}
