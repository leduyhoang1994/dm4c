<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-2 col-md-offset-0 form-login">
    <div class="logo-login">
        <img src="/images/SF18_logo.png">
    </div>
    <div class="tile-login">
        <p>Sign in by Gmail</p>
    </div>
    <div class="button-login">
        <!--                <button type="button" class="btn btn-default submit-login col-md-12"><i class="fa fa-google-plus" aria-hidden="true"></i></button>-->
        <?php use yii\authclient\widgets\AuthChoice; ?>
        <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
        <?php foreach ($authAuthChoice->getClients() as $client): ?>
            <?php
            echo $authAuthChoice->clientLink($client,
                '<i class="fa fa-google-plus" aria-hidden="true"></i>',
                [
                    'class' => 'btn btn-default submit-login col-md-12',
                ])
            ?>
        <?php endforeach; ?>
        <?php AuthChoice::end(); ?>
    </div>
</div>
<div class="title-bottom">
    <p>CoppyRight@2018 - <span class="item-title-bottom">TN18</span> - Một sản phẩm của dự án SF18</p>
</div>

<script>
</script>