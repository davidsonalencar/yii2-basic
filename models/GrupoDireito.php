<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_direito".
 *
 * @property integer $id_grupo
 * @property integer $id_direito
 *
 * @property Grupo $grupo
 * @property Direito $direito
 */
class GrupoDireito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_direito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo', 'id_direito'], 'required'],
            [['id_grupo', 'id_direito'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => Yii::t('app', 'Id Grupo'),
            'id_direito' => Yii::t('app', 'Id Direito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupo::className(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireito()
    {
        return $this->hasOne(Direito::className(), ['id_direito' => 'id_direito']);
    }
}
