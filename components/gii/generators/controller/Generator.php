<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components\gii\generators\controller;

/**
 * This generator will generate a controller and one or a few action view files.
 *
 * @property array $actionIDs An array of action IDs entered by the user. This property is read-only.
 * @property string $controllerClass The controller class name without the namespace part. This property is
 * read-only.
 * @property string $controllerFile The controller class file path. This property is read-only.
 * @property string $controllerID The controller ID (without the module ID prefix). This property is
 * read-only.
 * @property \yii\base\Module $module The module that the new controller belongs to. This property is
 * read-only.
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\generators\controller\Generator {

    /**
     * @var string the base class of the controller
     */
    public $baseClass = 'app\components\web\Controller';

}
