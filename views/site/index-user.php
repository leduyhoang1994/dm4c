<?php

/* @var $this yii\web\View */

$this->title = 'List Master project';

?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Hi there!</h1>
        <?php if ($confirmed) : ?>
            <p class="lead">Your api token is : <?= Yii::$app->user->identity->token ?></p>
        <?php else : ?>
            <p class="lead">Please wait patiently until your request is confirmed :3</p>
            <p>
                You can check your <a href="https://mail.google.com" target="_blank">gmail</a> for default password
            </p>
        <?php endif; ?>
    </div>
</div>
