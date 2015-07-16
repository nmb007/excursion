<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallerys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-view">

    <h1><?php echo Html::encode($this->title); ?>

    <div class="pull-right">
        <?php echo Html::a(Yii::t('app', 'Back'), ['admin'], ['class' => 'btn btn-warning']); ?>
        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this gallery?'),
                'method' => 'gallery',
            ],
        ]); ?>
    
    </div>
    </h1>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:html',
            'created_at:dateTime',
        ],
    ]); ?>

</div>
