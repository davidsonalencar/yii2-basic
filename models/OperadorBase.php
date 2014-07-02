<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operador".
 *
 * @property integer $id_operador
 * @property string $nome
 * @property string $senha
 * @property timestamp $dt_acesso
 * @property timestamp $dt_ultimo_acesso
 * @property string $ip_acesso
 * @property string $ip_ultimo_acesso
 * @property string $ip_restrito
 * @property integer $ativo
 *
 * @property Marcacao[] $marcacaos
 * @property OperadorDireito $operadorDireito
 * @property Direito[] $direitos
 * @property OperadorGrupo $operadorGrupo
 * @property Grupo[] $grupos
 */
class OperadorBase extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'operador';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'senha', 'dt_acesso', 'ip_acesso'], 'required'],
            [['dt_acesso', 'dt_ultimo_acesso'], 'safe'],
            [['ativo'], 'integer', 'integerPattern' => '^0|1$'],
            [['nome'], 'string', 'max' => 20],
            [['senha'], 'string', 'max' => 40],
            [['ip_acesso', 'ip_ultimo_acesso'], 'string', 'max' => 15],
            [['ip_restrito'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_operador' => Yii::t('app', 'Id Operador'),
            'nome' => Yii::t('app', 'Nome'),
            'senha' => Yii::t('app', 'Senha'),
            'dt_acesso' => Yii::t('app', 'Dt Acesso'),
            'dt_ultimo_acesso' => Yii::t('app', 'Dt Ultimo Acesso'),
            'ip_acesso' => Yii::t('app', 'Ip Acesso'),
            'ip_ultimo_acesso' => Yii::t('app', 'Ip Ultimo Acesso'),
            'ip_restrito' => Yii::t('app', 'Ip Restrito'),
            'ativo' => Yii::t('app', 'Ativo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaos() {
        return $this->hasMany(Marcacao::className(), ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadorDireito() {
        return $this->hasOne(OperadorDireito::className(), ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireitos() {
        return $this->hasMany(Direito::className(), ['id_direito' => 'id_direito'])->viaTable('operador_direito', ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadorGrupo() {
        return $this->hasOne(OperadorGrupo::className(), ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos() {
        return $this->hasMany(Grupo::className(), ['id_grupo' => 'id_grupo'])->viaTable('operador_grupo', ['id_operador' => 'id_operador']);
    }

}
