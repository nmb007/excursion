<?php
namespace app\modules\testimonial\models;

use app\models\User;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "{{%testimonial}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Testimonial extends ActiveRecord
{
    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%testimonial}}';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'content'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string'],
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
            'content' => Yii::t('app', 'Content'),
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
     * Gets the id of the testimonial creator.
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
     * Finds the Testimonial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer  $id
     * @return Testimonial The loaded model.
     * 
     * @throws NotFoundHttpException if the model cannot be found.
     */
    public function findModel($id)
    {
        if (($model = Testimonial::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
