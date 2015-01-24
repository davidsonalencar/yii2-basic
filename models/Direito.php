<?php

namespace app\models;

use Yii;
use app\models\queries\DireitoQuery;

/**
 * This is the model class for table "direito".
 *
 * @property integer $id_direito
 * @property integer $id_direito_pai
 * @property string $icon
 * @property string $label
 * @property string $url
 * @property integer $posicao
 * @property integer $tipo
 *
 * @property Direito $direitoPai
 * @property Direito[] $direitos
 * @property Grupo[] $grupos
 * @property Operador[] $operadores
 */
class Direito extends \yii\db\ActiveRecord {

    /**
     * Direitos para menus
     */
    const TIPO_MENU = 0;
    
    /**
     * Direitos para botoes
     */
    const TIPO_BOTAO = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'direito';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_direito_pai', 'posicao'], 'integer'],
            [['label', 'url', 'posicao'], 'required'],
            [['label'], 'string', 'max' => 45],
            [['url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_direito' => Yii::t('app', 'Id Direito'),
            'id_direito_pai' => Yii::t('app', 'Id Direito Pai'),
            'icon' => Yii::t('app', 'Icon'),
            'label' => Yii::t('app', 'Label'),
            'url' => Yii::t('app', 'Url'),
            'posicao' => Yii::t('app', 'Posicao'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function find() {
        
        return new DireitoQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireitoPai() {
        return $this->hasOne(Direito::className(), ['id_direito' => 'id_direito_pai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireitos() {
        return $this->hasMany(Direito::className(), ['id_direito_pai' => 'id_direito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoDireito() {
        return $this->hasOne(GrupoDireito::className(), ['id_direito' => 'id_direito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos() {
        return $this->hasMany(Grupo::className(), ['id_grupo' => 'id_grupo'])->viaTable('grupo_direito', ['id_direito' => 'id_direito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadorDireito() {
        return $this->hasOne(OperadorDireito::className(), ['id_direito' => 'id_direito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperadores() {
        return $this->hasMany(Operador::className(), ['id_operador' => 'id_operador'])->viaTable('operador_direito', ['id_direito' => 'id_direito']);
    }

}
