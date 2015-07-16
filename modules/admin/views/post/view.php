<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?php echo Html::encode($this->title) ?>

    <div class="pull-right">

    <?php if (Yii::$app->user->can('adminPost')): ?>

        <?php echo Html::a(Yii::t('app', 'Back'), ['admin'], ['class' => 'btn btn-warning']) ?>

    <?php endif ?>

    <?php if (Yii::$app->user->can('updatePost', ['model' => $model])): ?>

        <?php echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <?php endif ?>

    <?php if (Yii::$app->user->can('deletePost')): ?>

        <?php echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this post?'),
                'method' => 'post',
            ],
        ]) ?>

    <?php endif ?>
    
    </div>

    </h1>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            // [
            //     'label' => Yii::t('app', 'Author'),
            //     'value' => $model->authorName,
            // ],
            'title',
            'content:html',
            // [
            //     'label' => Yii::t('app', 'Status'),
            //     'value' => $model->statusName,
            // ],
            [
                'label' => Yii::t('app', 'Type'),
                'value' => $model->typeName,
            ],
            'created_at:dateTime',
            //'updated_at:dateTime',
        ],
    ]) ?>

</div>
