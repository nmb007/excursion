<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\testimonial\models\Testimonial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testimonial-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?php echo $form->field($model, 'content')->textArea(['rows' => 6]); ?>

    <div class="row">
    <div class="col-lg-6">

    </div>
    </div> 

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') 
            : Yii::t('app', 'Update'), ['class' => $model->isNewRecord 
            ? 'btn btn-success' : 'btn btn-primary']); ?>

        <?php echo Html::a(Yii::t('app', 'Cancel'), ['testimonial/index'], ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
