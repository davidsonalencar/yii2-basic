<?php

namespace app\modules\teste\controllers;

class DefaultController extends \app\components\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
