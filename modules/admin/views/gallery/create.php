<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\modules\gallery\Gallery */

$this->title = Yii::t('app', 'Create Gallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallery'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?php echo Html::encode($this->title); ?></h1>

    <div class="col-lg-8 well bs-component">

        <?php echo $this->render('_form', ['model' => $model]); ?>

    </div>

</div>
