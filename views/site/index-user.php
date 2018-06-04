<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Hi there!</h1>
        <?php if ($confirmed) : ?>
            <p class="lead">Your api token is : <?= Yii::$app->user->identity->token ?></p>
        <?php else : ?>
            <p class="lead">Please wait patiently until your request is confirmed :3</p>
        <?php endif; ?>
    </div>
</div>
