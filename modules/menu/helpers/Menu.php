<?php

namespace app\modules\menu\helpers;

use Yii;

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
     * @param Direito[] $direitos
     * @return []
     */
    private static function getItemsRecursivo( $direitos ) {
        
        $result = [];
        
        /* @var $direito \app\models\Direito */
        foreach ($direitos as $direito) {
            
            $item['label'] = $direito->label;
            $item['url']   = [ !empty($direito->url) ? $direito->url : $direito->id_direito ];
                             
            if (count($direito->direitos) > 0) {
                $item['items'] = static::getItemsRecursivo( $direito->direitos );
            }
            
            $result[] = $item;
                    
        }
        
        return $result;
        
    }
    
    /**
     * Retorna estrutura do menu 
     * @return []
     */
    public static function getItems() {
        
        $result = self::resolveCache()->get('menu');
        
        if (!empty($result)) {
            return $result;
        }
        
        $result = [];
            
        $identity = static::getIdentity();
            
        if (empty($identity)) {
            return $result;
        }

        $direitos = $identity->getDireitos()->menu()->with('direitos')->all();

        if (count($direitos) > 0) {
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
            'url' => ['user/account/logout'],
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
