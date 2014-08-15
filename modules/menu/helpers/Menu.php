<?php

namespace app\modules\menu\helpers;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of Menu
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class Menu {
    
    /**
     * Retorna a identidade do usuário logado
     * @return \app\models\Operador
     */
    private static function getIdentity() {
        
        return Yii::$app->getUser()->getIdentity();
        
    }
    
    /**
     * @param [] $direitos
     * @return []
     */
    private static function getItemsRecursivo( $direitos, $id_direito_pai = null ) {
    
        $result = [];

        foreach ($direitos as $direito) {
            if ($direito['id_direito_pai'] == $id_direito_pai) {
                
                $item = [
                    'label' => $direito['label'],
                    'url' => [ '/'. ( !empty($direito['url']) ? $direito['url'] : $direito['id_direito'] ) ],
                ];
                
                $items = self::getItemsRecursivo($direitos, $direito['id_direito']);
                
                if ($items) {
                    $item['items'] = $items;
                }
                $result[] = $item;
            }
        }

        return $result;
    }
    
    /**
     * Retorna estrutura do menu 
     * @return []
     */
    public static function getItems() {
        
     //   $result = self::resolveCache()->get('menu');
        
        if (!empty($result)) {
            return $result;
        }
        
        $result = [];
            
        $identity = static::getIdentity();
            
        if (empty($identity)) {
            return $result;
        }

        $direitos = $identity->getTodosDireitos()->menu()->orderBy('id_direito_pai, posicao')->asArray()->all();
        
        if (ArrayHelper::count($direitos) > 0) {
            $result = static::getItemsRecursivo( $direitos );
        }

        $result[] = static::getItemLogout();

        self::resolveCache()->set('menu', $result);

        return $result; 
        
    }
    
    /**
     * Verifica se deve permanecer aqui quando desenvolver o layout admin
     * @return array
     */
    private static function getItemLogout() {
        
        return [
            'label' => 'Logout (' . Yii::$app->user->identity->nome . ')',
            'url' => [ '/logout' ],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    
    /**
     * Returns cache component configured as in cacheId
     * @return \app\components\caching\SessionCache
     */
    private static function resolveCache() {
        return Yii::$app->getCache();
    }
    
}
