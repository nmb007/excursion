<?php

namespace app\modules\testimonial\controllers;

use app\modules\testimonial\models\Testimonial;
use app\modules\testimonial\models\TestimonialSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UploadedFile;
use Yii;


class TestimonialController extends Controller
{
    public $layout = 'backend';
    
    /**
     * Lists all Testimonial models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * How many testimonials we want to display per page.
         * @var integer
         */
        $pageSize = 5;

        $searchModel = new TestimonialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testimonial model.
     * 
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Testimonial();
        return $this->render('view', [
            'model' => $model->findModel($id),
        ]);
    }

    /**
     * Creates a new Testimonial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Testimonial();

        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            
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
     * Updates an existing Testimonial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $testModel = new Testimonial();
        $model = $testModel->findModel($id);
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Testimonial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $testModel = new Testimonial();
        $testModel->findModel($id)->delete();

        return $this->redirect('admin');
    }

    /**
     * Manage Testimonials.
     * 
     * @return mixed
     */
    public function actionAdmin()
    {
        /**
         * How many testimonials we want to display per page.
         * @var integer
         */
        $pageSize = 5;

        $searchModel = new TestimonialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
