<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property integer $id_grupo
 * @property string $nome
 * @property string $ip_restrito
 *
 * @property GrupoDireito $grupoDireito
 * @property Direito[] $direitos
 * @property OperadorGrupo $operadorGrupo
 * @property Operador[] $operadores
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo', 'nome'], 'required'],
            [['id_grupo'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['ip_restrito'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => Yii::t('app', 'Id Grupo'),
            'nome' => Yii::t('app', 'Nome'),
            'ip_restrito' => Yii::t('app', 'Ip Restrito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoDireito()
    {
        return $this->hasOne(GrupoDireito::className(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireitos()
    {
        return $this->hasMany(Direito::className(), ['id_direito' => 'id_direito'])->viaTable('grupo_direito', ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadorGrupo()
    {
        return $this->hasOne(OperadorGrupo::className(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadores()
    {
        return $this->hasMany(Operador::className(), ['id_operador' => 'id_operador'])->viaTable('operador_grupo', ['id_grupo' => 'id_grupo']);
    }
}
