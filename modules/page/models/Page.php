<?php
namespace app\modules\post\models;

use app\models\User;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $type
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Post extends ActiveRecord
{
    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;

    const TYPE_TOUR = 1;
    const TYPE_BLOG = 2;
    
    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content', 'status'], 'required'],
            [['user_id', 'status', 'type'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }
    
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets the id of the post creator.
     * NOTE: needed for RBAC Author rule.
     * 
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->user_id;
    }

    /**
     * Gets the author name from the related User table.
     * 
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->user->user_name;
    }

    /**
     * Returns the post status in nice format.
     *
     * @param  null|integer $status Status integer value if sent to method.
     * @return string               Nicely formatted status.
     */
    public function getStatusName($status = null)
    {
        $status = (empty($status)) ? $this->status : $status ;

        if ($status === self::STATUS_DRAFT)
        {
            return Yii::t('app', 'Draft');
        }
        else
        {
            return Yii::t('app', 'Published');
        }
    }

    /**
     * Returns the array of possible post status values.
     *
     * @return array
     */
    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_DRAFT     => Yii::t('app', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('app', 'Published'),
        ];

        return $statusArray;
    }

    /**
     * Returns the post type in nice format.
     *
     * @param  null|integer $post Post integer value if sent to method.
     * @return string                 Nicely formatted Post.
     */
    public function getTypeName($post = null)
    {
        $post = (empty($post)) ? $this->type : $post ;

        if ($post === self::TYPE_TOUR)
        {
            return Yii::t('app', 'Tour');
        }
        elseif ($post === self::TYPE_BLOG)
        {
            return Yii::t('app', 'Blog');
        }
    }

    /**
     * Returns the array of possible post type values.
     *
     * @return array
     */
    public function getTypeList()
    {
        $statusArray = [
            self::TYPE_TOUR => Yii::t('app', 'Tour'),
            self::TYPE_BLOG => Yii::t('app', 'Blog'),
        ];

        return $statusArray;
    }
    
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer  $id
     * @return Post The loaded model.
     * 
     * @throws NotFoundHttpException if the model cannot be found.
     */
    public function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
