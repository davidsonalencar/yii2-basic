<?php

namespace app\models;

use \yii\helpers\ArrayHelper;

class Operador extends OperadorBase implements \yii\web\IdentityInterface {

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
        //return Security::validatePassword($senha, $this->password_hash);
    }
    
    /**
     * @auth
     * Generates auth key.
     * @return string auth key.
     */
    protected function generateAuthKey() {
        $parts = array(
            $this->nome,
            $this->senha,
            $this->ip_acesso
        );
        return sha1(implode('/', $parts));
    }
    
    /**
     * @param Direito[] $direitos
     * @return []
     */
    private function getMenuRecursivo( $direitos ) {
        
        $result = [];
        
        foreach ($direitos as $direito) {
            
            $item = [
                'label' => $direito->label,
                'url' => [$direito->url]
            ];
            
            if (count($direito->direitos) > 0) {
                $item['items'] = $this->getMenuRecursivo( $direito->direitos );
            }
            
            $result[] = $item;
                    
        }
        
        return $result;
        
    }
    
    /**
     * Usado em app\components\yii\web\Controller
     * @return []
     */
    public function getMenu() {
        
        $result = [];
        
        if (count($this->direitos) > 0) {
            $result = $this->getMenuRecursivo( $this->direitos );
        }
        
        return $result; 
        
    }
    
    /**
     * 
     * @param Direito[] $direitos
     * @param string $moduleId
     * @param string $controllerId
     * @return []
     */
    private function getAcoesRecursivo( $direitos, $moduleId, $controllerId ) {
        
        $result = [];
        
        foreach ($direitos as $direito) {
        
            if ($direito->getModule() === $moduleId && 
                $direito->getController() === $controllerId) {
                $result[] = $direito->getAction();
            }
                    
            if (count($direito->direitos) > 0) {
                
                $acoes = $this->getAcoesRecursivo( $direito->direitos, $moduleId, $controllerId );
                
                $result = ArrayHelper::merge( $result, $acoes );
                
            }

        }
        
        return $result;
        
    }
    
    public function getAcoes( $moduleId, $controllerId ) {
        
        $result = [];
        
        if (count($this->direitos) > 0) {
            $result = $this->getAcoesRecursivo( $this->direitos, $moduleId, $controllerId );
        }
        
        return $result; 
        
    }
    
}