<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Page');
?>

<table class="table">
    <tr>
        <th>
            Options
        </th>
    </tr>

    <?php foreach ($options as $key => $option): ?>
        <tr>
            <td><?php echo Html::a($option, array('page/banner'), array('class' => 'btn btn-primary')); ?></td>

        </tr>

    <?php endforeach; ?>
</table>
