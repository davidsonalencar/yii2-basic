<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2014 Davidson
 */

namespace yii\helpers;

/**
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class ArrayHelper extends \yii\helpers\BaseArrayHelper {
    
    /**
     * Conta os elementos de um array, ou propriedades em um objeto. 
     * 
     * @param Array|Object $var
     * @param integer $mode
     * @return integer Retorna o número de elementos em var, que normalmente é um array. Se $var não for um array ou um objeto, retorna 0.
     */
    public static function count($var, $mode = 0) {
        
        $result = count($var, $mode);
        if (!is_int($result)) {
            $result = 0;
        }
        return $result;
    }            
    
}
