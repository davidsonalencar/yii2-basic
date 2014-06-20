<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * Rotina para enviar emails
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @since 2.0
 */
class EmailController extends Controller {

    /**
     * Ação default para iniciar a rotina de email
     * Exemplo do comando que deve ser agendado:
     *     # php yii email
     */
    public function actionIndex() {
        echo "enviar emails";
    }

}
