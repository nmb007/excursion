<?php

namespace app\modules\admin\controllers;

use app\modules\page\models\Page;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UploadedFile;
use Yii;


class PageController extends Controller
{
    
    public $layout = 'backend';
    
    /**
     * Show all available options.
     * 
     * @return mixed
     */
    public function actionAdmin()
    {
        $options = Page::getOptionsList();
        
        return $this->render('admin', [
                    'options' => $options,
        ]);
    }
}
