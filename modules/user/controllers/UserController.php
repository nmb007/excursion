<?php

namespace app\modules\user\controllers;

use yii\web\Controller;
use Yii;

class UserController extends Controller
{
    public function actionContact()
    {
        return $this->render('contact');
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
