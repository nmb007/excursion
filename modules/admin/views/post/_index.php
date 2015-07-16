<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Posts';
?>

    <h2>
        <a href=<?php echo Url::to(['post/view', 'id' => $model->id]) ?>><?php echo $model->title ?></a>
    </h2>

    <p class="time"><span class="glyphicon glyphicon-time"></span> 
        <?php echo Yii::t('app', 'Published on') ?> : <?php echo Yii::$app->formatter->asDate($model->created_at, 'j/m/Y, G:i'); ?></p>

    <br>

    <p><?php echo $model->content ?></p>

    <a class="btn btn-primary" href=<?php echo Url::to(['post/view', 'id' => $model->id]) ?>>
        <?php echo Yii::t('app', 'Read more') ?> <span class="glyphicon glyphicon-chevron-right"></span>
    </a>

    <hr class="article-devider">
