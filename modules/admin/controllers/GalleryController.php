<?php

namespace app\modules\admin\controllers;

use app\modules\gallery\models\Gallery;
use app\modules\gallery\models\GallerySearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UploadedFile;
use Yii;


class GalleryController extends Controller
{
    public $layout = 'backend';
    
    /**
     * Lists all Gallery models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * How many gallerys we want to display per page.
         * @var integer
         */
        $pageSize = 5;

        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
     * 
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = new Gallery();
        
        return $this->render('view', [
            'model' => $model->findModel($id),
        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if ($model->load(Yii::$app->request->post())) 
        {
            /* Gets the image instance and uploads image to the specified directory
             * and then saves the model data */
            
            $image = UploadedFile::getInstance($model, 'image');   
            
            $image->saveAs('uploads/' . $image->baseName . '.' . $image->extension);
            $model->image = $image->baseName . '.' . $image->extension;
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $gallery = new Gallery();
        $model = $gallery->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $gallery = new Gallery();
        $gallery->findModel($id)->delete();

        return $this->redirect('admin');
    }

    /**
     * Manage Gallerys.
     * 
     * @return mixed
     */
    public function actionAdmin()
    {
        /**
         * How many gallerys we want to display per page.
         * @var integer
         */
        $pageSize = 5;

        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
}
