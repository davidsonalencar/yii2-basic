<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
    
class AccountController extends Controller {

    public function behaviors() {

        $config = parent::behaviors();
        
        $config['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ];
        
        
        /*
         * usado no AccessControl
        $config['access'] = ArrayHelper::merge($config['access'], [
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['login'],
                    'roles' => ['?'],
                ],
                [
                    'allow' => true,
                    'actions' => ['logout'],
                    'roles' => ['@'],
                ],
            ]
        ]);*/
        
        return $config;
    }
    
    public function actions() {        
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionLogin() {
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            return $this->goBack();
        } else {
            
            $this->layout = 'login';
            
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        
    }
    
    public function actionLogout() {
        
        Yii::$app->user->logout();

        return $this->goHome();
        
    }
    
}
