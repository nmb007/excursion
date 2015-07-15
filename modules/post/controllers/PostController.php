<?php

namespace app\modules\post\controllers;

use app\modules\post\models\Post;
use app\modules\post\models\PostSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UploadedFile;
use Yii;


class PostController extends Controller
{
    
    public $layout = 'backend';
    
    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin'],
                        'allow' => true,
                        'roles' => ['editor', 'admin'],
                        'denyCallback' => function ($rule, $action) {
                            return $this->redirect('/',301);
                        }
                    ],
                    [
                        // other rules
                    ],

                ], // rules

            ], // access

        ]; // return

    } // behaviors
    
    /**
     * Lists all Post models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /**
         * How many posts we want to display per page.
         * @var integer
         */
        $pageSize = 2;

        /**
         * Posts have to be published.
         * @var boolean
         */
        $published = true;

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $published);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * 
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Post();
        return $this->render('view', [
            'model' => $model->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        $model->user_id = Yii::$app->user->id;

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
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $postModel = new Post();
        $model = $postModel->findModel($id);

        if (Yii::$app->user->can('updatePost', ['model' => $model])) 
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            throw new MethodNotAllowedHttpException(Yii::t('app', 'You are not allowed to access this page.'));
        } 
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $postModel = new Post();
        $postModel->findModel($id)->delete();

        return $this->redirect('admin');
    }

    /**
     * Manage Posts.
     * 
     * @return mixed
     */
    public function actionAdmin()
    {
        /**
         * How many posts we want to display per page.
         * @var integer
         */
        $pageSize = 5;

        /**
         * Only admin+ roles can see everything.
         * Editors will be able to see only published posts and their own drafts @see: search(). 
         * @var boolean
         */
        $published = (Yii::$app->user->can('admin')) ? false : true ;

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $published);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
