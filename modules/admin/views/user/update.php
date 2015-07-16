<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $role app\rbac\models\Role */

$this->title = Yii::t('app', 'Update User') . ': ' . $user->user_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->user_name, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="col-lg-5 well bs-component">

        <?php echo $this->render('_form', [
            'user' => $user,
            'role' => $role,
        ]) ?>

    </div>

</div>
