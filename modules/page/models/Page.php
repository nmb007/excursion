<?php
namespace app\modules\page\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 
 * @property string $name
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class Page extends ActiveRecord
{
    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Returns the array of possible page options.
     *
     * @return array
     */
    public static function getOptionsList()
    {
        $optionsArray = [
            'banner_content'     => Yii::t('app', 'Homepage banner content'),
            'mid_content' => Yii::t('app', 'Homepage mid page content'),
            'footer_about_us' => Yii::t('app', 'Footer About us'),
            'footer_address' => Yii::t('app', 'Footer Address'),
        ];

        return $optionsArray;
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
        if (($model = Page::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
