<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Testimonials';
?>

    <p class="time"><span class="glyphicon glyphicon-time"></span> 
        <?php echo Yii::t('app', 'Published on'); ?> : <?php echo Yii::$app->formatter->asDate($model->created_at, 'j/m/Y, G:i'); ?></p>

    <br>

    <p><?php echo $model->content; ?></p>

    <a class="btn btn-primary" href=<?php echo Url::to(['testimonial/view', 'id' => $model->id]); ?>>
        <?php echo Yii::t('app', 'Read more'); ?> <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

    <hr class="article-devider">
