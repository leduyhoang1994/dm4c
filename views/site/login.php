<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    body,*{
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }
    .main-container{
        background-image: url(<?= Yii::$app->request->baseUrl.'/images/bg_login.jpg' ?>);
        background-repeat: no-repeat;
        background-size: 100%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
    .main-body{
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0,0,0,0.8);
    }
    .logo-login img{
        float: none;
        margin: 0 auto;
        display: block;
        width: 100%;
    }
    .form-login{
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
    }
    .submit-login{
        background-color: #e89e35;
        float: none;
        margin: 0 auto;
        display: block;
        height: 44px;
        padding: 4px 0;
    }
    .submit-login:hover{
        background-color: #af6805;
    }
    .submit-login i{
        color: #fff;
        font-size: 24px;
    }
    .tile-login{
        position: relative;
        padding: 20px 0;
    }
    .tile-login p{
        text-align: center;
        color: #fff;
        opacity: 0.7;
        font-weight: 400;
    }
    .tile-login p:after{
        color: #fff;
        display: block;
        content: "";
        position: absolute;
        top: 45%;
        width: 25%;
        height: 1px;
        background: white;
        opacity: 0.3;
    }
    .tile-login p:before{
        color: #fff;
        display: block;
        content: "";
        position: absolute;
        top: 45%;
        width: 25%;
        height: 1px;
        background: white;
        right: 0;
        opacity: 0.3;
    }
    .title-bottom{
        position: absolute;
        bottom: 10px;
        float: none;
        margin: 0 auto;
        width: 100%;
    }
    .title-bottom p{
        color: #fff;
        text-align: center;
    }
    .item-title-bottom{
        color:  #e89e35;
    }
</style>

<div class="main-container">
    <div class="main-body">
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
    </div>
</div>

<script>
</script>