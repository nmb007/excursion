<?php

namespace app\modules\post\controllers;

use yii\web\Controller;

class ToursController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
