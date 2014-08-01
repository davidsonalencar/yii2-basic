<?php

namespace app\controllers;

class SiteController extends \app\components\web\Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
