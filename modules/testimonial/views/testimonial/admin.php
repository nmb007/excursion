<?php
use app\helpers\CssHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestimonialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Testimonials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonials-admin">

    <h1>

    <?php echo Html::encode($this->title); ?>

    <span class="pull-right">
        <?php echo Html::a(Yii::t('app', 'Create Testimonial'), ['create'], ['class' => 'btn btn-success']); ?>
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
            // status
                        ['class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Menu')],
        ],
    ]); ?>

</div>
