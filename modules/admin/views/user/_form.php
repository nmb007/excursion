<?php
use app\rbac\models\AuthItem;
//use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $role app\rbac\models\Role; */
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?php echo $form->field($user, 'user_name') ?>
        
        <?php echo $form->field($user, 'email') ?>
        
        <?php echo $form->field($user, 'password') ?>
        

    <div class="row">
    <div class="col-lg-6">

        <?php echo $form->field($user, 'status')->dropDownList($user->statusList) ?>

        <?php foreach (AuthItem::getRoles() as $item_name): ?>
            <?php $roles[$item_name->name] = $item_name->name ?>
        <?php endforeach ?>
        <?php echo $form->field($role, 'item_name')->dropDownList($roles) ?>
        
        <?php echo $form->field($user, 'image')->fileInput(); ?>

    </div>
    </div>

    <div class="form-group">     
        <?php echo Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') 
            : Yii::t('app', 'Update'), ['class' => $user->isNewRecord 
            ? 'btn btn-success' : 'btn btn-primary']) ?>

        <?php echo Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 
</div>
