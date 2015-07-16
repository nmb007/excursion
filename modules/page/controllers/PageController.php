<?php

namespace app\modules\page\controllers;
use yii\web\Controller;
use Yii;

class PageController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }    
}

