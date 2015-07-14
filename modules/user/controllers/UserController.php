<?php

namespace app\modules\user\controllers;

use app\models\User;
use app\models\UserSearch;
use app\rbac\models\Role;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class UserController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin', 'logout'],
                        'allow' => true,
                        'roles' => ['admin'],
                        'denyCallback' => function ($rule, $action) {
                            return $this->redirect('/',301);
                        }
                    ],
                    [
                        //'controllers' => ['user'],
                        'actions' => ['contact'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        // other rules
                    ],

                ], // rules

            ], // access

        ]; // return

    } // behaviors
    
    public function actionContact()
    {
        return $this->render('contact');
    }
    
    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        /**
         * How many users we want to display per page.
         * @var int
         */
        $pageSize = 5;

        /**
         * Only admin role can see all users.
         * Lower roles will not be able to see admin @see: search(). 
         * @var boolean
         */
        $admin = (Yii::$app->user->can('admin')) ? true : false ;

        
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $admin);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = new User();
        $role = new Role();

        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && User::validateMultiple([$user, $role]))
        {
            $user->setPassword($user->password);
            $user->generateAuthKey();
            
            if ($user->save()) 
            {
                $role->user_id = $user->getId();
                $role->save(); 
            }  

            return $this->redirect('index');      
        } 
        else 
        {
            return $this->render('create', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    /**
     * Updates an existing User and Role models.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);

        // only the Admin can update everyone`s roles
        // admin will not be able to update role of Admin
        if (!Yii::$app->user->can('admin')) 
        {
            if ($role->item_name === 'admin') 
            {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) && 
            $role->load(Yii::$app->request->post()) && User::validateMultiple([$user, $role])) 
        {
            // only if user entered new password we want to hash and save it
            if ($user->password) 
            {
                $user->setPassword($user->password);
            }

            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) 
            {
                $user->removeAccountActivationToken();
            }            

            $user->save(false);
            $role->save(false); 
            
            return $this->redirect(['view', 'id' => $user->id]);
        }
        else 
        {
            return $this->render('update', [
                'user' => $user,
                'role' => $role,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id The user id.
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id'=>$id])->one()) 
        {
            $role->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer $id The user id.
     * @return User The loaded model.
     *
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
