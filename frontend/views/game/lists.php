<?php
use frontend\models\Math;
use yii\helpers\Url;

$this->title = 'Mathematics game';

use yii\grid\GridView;

?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <a href="<?= Url::to(['/game']) ?>" class="btn btn-success pull-right">Start Again</a>
        <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">Back Home</a>
        <?php

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'rowOptions' => function ($model) {
                if ($model->result == $model->answer) {
                    return ['class' => 'success'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'task',
                'result',
                'answer',
                //'ip'
                [
                    'attribute'=>'created_at',
                    'format'=>['datetime']
                ]
            ],
        ]); ?>
    </div>
</div>