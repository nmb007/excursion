<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Gallerys';
?>

    <h2>
        <a href=<?php echo Url::to(['gallery/view', 'id' => $model->id]); ?>><?php echo $model->title; ?></a>
    </h2>

    <p class="time"><span class="glyphicon glyphicon-time"></span> 
        <?php echo Yii::t('app', 'Created on'); ?> : <?php echo Yii::$app->formatter->asDate($model->created_at, 'j/m/Y, G:i'); ?></p>

    <br>

    <p><?php echo $model->description; ?></p>

    <a class="btn btn-primary" href=<?php echo Url::to(['gallery/view', 'id' => $model->id]); ?>>
        <?php echo Yii::t('app', 'Read more'); ?> <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

    <hr class="article-devider">
