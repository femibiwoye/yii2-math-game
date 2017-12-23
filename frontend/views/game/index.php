<?php
use frontend\models\Math;

$this->title = 'Mathematics game';

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php Pjax::begin(); ?>
        <?= Html::beginForm(['/game'], 'post', ['data-pjax' => '', 'class' => 'form-inline','id' => 'play-game']); ?>
        <div class="well">
            <label><?= $a . ' ' . $operator . ' ' . $b ?> = ?</label>
            <label class="pull-right"><?=Yii::$app->session->get('counter')?> of 5</label>
        </div>
        <div class="form-group">
            <?= Html::input('text', 'answer', null, ['class' => 'form-control', 'placeholder' => 'Answer','required'=>true]) ?>
            <?= Html::input('hidden', 'a', $a) ?>
            <?= Html::input('hidden', 'b', $b) ?>
            <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-success']) ?>
        </div>
        <?php if(!empty($result)): ?>
        <hr>
        <div class="alert alert-info">
            <?= $correctAnswer ?>
        </div>
        <?php endif; ?>
        <?= Html::endForm() ?>
        <?php Pjax::end(); ?>
    </div>
</div>