<?php
use app\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-admin">

    <h1>

    <?php echo Html::encode($this->title) ?>

    <span class="pull-right">
        <?php echo Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </span>  

    </h1>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            // author
            [
                'attribute'=>'user_id',
                'value' => function ($data) {
                    return $data->getAuthorName();
                },
            ],
            'title',
            // status
            [
                'attribute'=>'status',
                'filter' => $searchModel->statusList,
                'value' => function ($data) {
                    return $data->getStatusName($data->status);
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::postStatusCss($model->statusName)];
                }
            ],
            [
                'attribute'=>'type',
                'filter' => $searchModel->typeList,
                'value' => function ($data) {
                    return $data->getTypeName($data->type);
                },
                'contentOptions'=>function($model, $key, $index, $column) {
                    return ['class'=>CssHelper::postTypeCss($model->typeName)];
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Menu')],
        ],
    ]); ?>

</div>
