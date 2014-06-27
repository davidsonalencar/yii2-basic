<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operador".
 *
 * @property integer $id_operador
 * @property string $operador
 * @property string $senha
 * @property string $dt_ultimo_acesso
 * @property string $ip_acesso
 * @property string $ip_ultimo_acesso
 * @property string $ip_restrito
 *
 * @property OperadorDireito $operadorDireito
 * @property Direito[] $direitos
 * @property OperadorGrupo $operadorGrupo
 * @property Grupo[] $grupos
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
            [['id_operador', 'operador', 'senha', 'ip_acesso'], 'required'],
            [['id_operador'], 'integer'],
            [['dt_ultimo_acesso'], 'safe'],
            [['operador'], 'string', 'max' => 20],
            [['senha'], 'string', 'max' => 32],
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
            'operador' => Yii::t('app', 'Operador'),
            'senha' => Yii::t('app', 'Senha'),
            'dt_ultimo_acesso' => Yii::t('app', 'Dt Último Acesso'),
            'ip_acesso' => Yii::t('app', 'Ip Acesso'),
            'ip_ultimo_acesso' => Yii::t('app', 'Ip Último Acesso'),
            'ip_restrito' => Yii::t('app', 'Ip Restrito'),
        ];
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
     * Encontra uma identidade pelo ID informado.
     * 
     * @inheritdoc
     * @param integer $id O ID que deve ser encontrado
     * @return \app\models\Operador|null O objeto da identidade Operador correspondente ao ID informado.
     */
    public static function findIdentity($id) {
        return static::findOne($id);

//        if (is_object($user)) {;
//            $user->updateLastVisitTime();
//        }
//        return $user;
    }

    /**
     * Recurso não implementado
     * Encontra uma identidade pelo token informado.
     * 
     * @param string $token O token que deve ser encontrado
     * @return \app\models\Operador|null O objeto da identidade Operador correspondente ao token informado.
     */
    public static function findIdentityByAccessToken($token) {
        //return static::findOne(['access_token' => $token]);
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Valida a senha informada
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($senha) {
        return $this->senha === sha1($senha);
        //return Security::validatePassword($senha, $this->password_hash);
    }

    /**
     * @auth
     * @param string $username user name.
     * @return null|\yii\db\ActiveRecord user instance.
     */
    public static function findByNome($username) {
        // mudar para operador para nome
        return static::findOne(array('operador' => $username/* , 'status_id' => static::STATUS_ACTIVE */));
    }

    /**
     * @auth
     * Generates auth key.
     * @return string auth key.
     */
    protected function generateAuthKey() {
        $parts = array(
            $this->operador,
            $this->senha,
            $this->ip_acesso
        );
        return sha1(implode('/', $parts));
    }

}
