<?php

use yii\helpers\Url;

$this->title = 'Welcome to math game testing';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Math Game</h1>

        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['/game'])?>">Start game</a></p>
    </div>
</div>
