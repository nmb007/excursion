<?php

namespace app\modules\testimonial\controllers;

use yii\web\Controller;

class TestimonialController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
