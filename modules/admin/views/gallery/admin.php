<?php
use app\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gallerys');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallerys-admin">

    <h1>

    <?php echo Html::encode($this->title); ?>

    <span class="pull-right">
        <?php echo Html::a(Yii::t('app', 'Create Gallery'), ['create'], ['class' => 'btn btn-success']); ?>
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
                'attribute'=>'id',
                'value' => function ($data) {
                    return $data->getId();
                },
            ],
            'title',

            ['class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Menu')],
        ],
    ]); ?>

</div>
