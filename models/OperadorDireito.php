<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operador_direito".
 *
 * @property integer $id_operador
 * @property integer $id_direito
 *
 * @property Operador $operador
 * @property Direito $direito
 */
class OperadorDireito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operador_direito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_operador', 'id_direito'], 'required'],
            [['id_operador', 'id_direito'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_operador' => Yii::t('app', 'Id Operador'),
            'id_direito' => Yii::t('app', 'Id Direito'),
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
    public function getDireito()
    {
        return $this->hasOne(Direito::className(), ['id_direito' => 'id_direito']);
    }
}
