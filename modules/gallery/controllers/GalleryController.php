<?php

namespace app\modules\gallery\controllers;

use yii\web\Controller;

class GalleryController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
