<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operador_grupo".
 *
 * @property integer $id_operador
 * @property integer $id_grupo
 *
 * @property Operador $operador
 * @property Grupo $grupo
 */
class OperadorGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operador_grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_operador', 'id_grupo'], 'required'],
            [['id_operador', 'id_grupo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_operador' => Yii::t('app', 'Id Operador'),
            'id_grupo' => Yii::t('app', 'Id Grupo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperador()
    {
        return $this->hasOne(Operador::className(), ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['id_grupo' => 'id_grupo']);
    }
}
