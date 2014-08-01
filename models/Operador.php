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
 * @property Direito[] $direitos
 * @property Grupo[] $grupos
 * 
 */
class Operador extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

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
            /**
             * Scenario Default
             */
            [['nome', 'senha', 'dt_acesso', 'ip_acesso'], 'required'],
            [['dt_acesso', 'dt_ultimo_acesso'], 'safe'],
            [['ativo'], 'integer', 'integerPattern' => '^0|1$'],
            [['nome'], 'string', 'max' => 20],
            [['senha'], 'string', 'max' => 40],
            [['ip_acesso', 'ip_ultimo_acesso'], 'string', 'max' => 15],
            [['ip_restrito'], 'string', 'max' => 250],
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
     * @return queries\DireitoQuery
     */
    public function getDireitos() {
        return $this->hasMany(Direito::className(), ['id_direito' => 'id_direito'])->viaTable('operador_direito', ['id_operador' => 'id_operador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos() {
        return $this->hasMany(Grupo::className(), ['id_grupo' => 'id_grupo'])->viaTable('operador_grupo', ['id_operador' => 'id_operador']);
    }

    /**
     * IMPLEMENTACAO DA INTERFACE
     */
    
    /**
     * @inheritdoc
     * @return string Chave de autenticação de usuário atual
     */
    public function getAuthKey() {
        
        return $this->generateAuthKey();
    }
    
    /**
     * @inheritdoc
     * @return integer Retorna o ID do operador
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * @param string $authKey
     * @return boolean Se chave de autenticação é válida para o usuário atual
     */
    public function validateAuthKey($authKey) {

        return $this->getAuthKey() === $authKey;
    }

    /**
     * 
     * @inheritdoc
     * @param integer $id O ID que deve ser encontrado
     * @return \app\models\Operador|null O objeto da identidade Operador correspondente ao ID informado.
     */
    public static function findIdentity($id) {
        
        $identity = @unserialize(static::resolveCache()->get('identity:'.$id));
        
        if ($identity === false) {
            
            $identity = static::findOne($id);
            static::resolveCache()->set('identity:'.$id, @serialize($identity));
        }
        
        return $identity;
    }

    /**
     * Recurso não implementado
     * Encontra uma identidade pelo token informado.
     * 
     * @param string $token O token que deve ser encontrado
     * @return \app\models\Operador|null O objeto da identidade Operador correspondente ao token informado.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        $token = null;
        //return static::findOne(['access_token' => $token]);
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    /**
     * PERSISTENCIA
     */
    
    /**
     * @auth
     * @param string $username user name.
     * @return null|\yii\db\ActiveRecord user instance.
     */
    public static function findByNome($username) {
        // mudar para operador para nome
        return static::findOne(array('nome' => $username/* , 'status_id' => static::STATUS_ACTIVE */));
    }    
    
        /**
     * REGRAS DE NEGÓCIO
     */

    /**
     * Valida a senha informada
     *
     * @param string $senha password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($senha) {
        return $this->senha === sha1($senha);
    }
    
    /**
     * @auth
     * Generates auth key.
     * @return string auth key.
     */
    public function generateAuthKey() {
        
        $parts = array(
            $this->nome,
            $this->senha,
            $this->ip_acesso
        );
        return sha1(implode('/', $parts));
    }
  
    /**
     * Returns cache component configured as in config
     * @return \app\components\caching\SessionCache
     */
    public static function resolveCache() {
        return Yii::$app->getCache();
    }
    
}
