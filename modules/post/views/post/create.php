<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\modules\post\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="col-lg-8 well bs-component">

        <?php echo $this->render('_form', ['model' => $model]) ?>

    </div>

</div>
