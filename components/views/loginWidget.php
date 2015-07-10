<?php
use yii\bootstrap\ActiveForm; 
use yii\helpers\Html;
?>
<div class="panel panel-default">
  <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($user, 'username', [
              'inputOptions' => [
                  'placeholder' => $user->getAttributeLabel('username'),
              ],
            ])->label(false);
        ?>
        <?= $form->field($user, 'password', [
              'inputOptions' => [
                  'placeholder' => $user->getAttributeLabel('password'),
              ],
            ])->passwordInput()->label(false);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
