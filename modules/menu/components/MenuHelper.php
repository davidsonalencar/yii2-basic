<?php

namespace app\modules\menu\components;

use Yii;

/**
 * Description of Menu
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 */
class MenuHelper {
    
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
    private static function getMenuRecursivo( $direitos ) {
        
        $result = [];
        
        foreach ($direitos as $direito) {
            
            $item['label'] = $direito->label;
            if (!empty($direito->url)) {
                $item['url'] = [$direito->url];
            }
                             
            if (count($direito->direitos) > 0) {
                $item['items'] = static::getMenuRecursivo( $direito->direitos );
            }
            
            $result[] = $item;
                    
        }
        
        return $result;
        
    }
    
    /**
     * Retorna estrutura do menu 
     * @return []
     */
    public static function getMenu() {
        
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
            $result = static::getMenuRecursivo( $direitos );
        }

        $result[] = static::getMenuLogout();

        self::resolveCache()->set('menu', $result);
        
        return $result; 
        
    }
    
    /**
     * Verifica se deve permanecer aqui quando desenvolver o layout admin
     * @return array
     */
    private static function getMenuLogout() {
        
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
