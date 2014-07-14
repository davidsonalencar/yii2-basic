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
class VarDumper extends \yii\helpers\BaseVarDumper {
    
    public static function dump($var, $depth = 10, $highlight = true) {
        parent::dump($var, $depth, $highlight);
        die();
    }            
    
}
