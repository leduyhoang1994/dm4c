<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginBlock('myCss') ?>
<link href="/css/custom/index.css" rel="stylesheet">
<?php $this->endBlock() ?>
<div class="col-md-3 col-md-offset-5 form-login">
    <div class="logo-login">
        <img src="/images/SF18_list_master.png">
    </div>
    <div class="tile-login">
        <p>Sign in by Gmail</p>
    </div>
    <div class="button-login col-md-12">
        <!--                <button type="button" class="btn btn-default submit-login col-md-12"><i class="fa fa-google-plus" aria-hidden="true"></i></button>-->
        <?php use yii\authclient\widgets\AuthChoice; ?>
        <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => true, 'popupMode' => true,]); ?>
        <?php foreach ($authAuthChoice->getClients() as $client): ?>
            <?php
            echo $authAuthChoice->clientLink($client,
                '<i class="fa fa-google-plus" aria-hidden="true"></i>',
                [
                    'class' => 'btn submit-login w-100',
                ])
            ?>
        <?php endforeach; ?>
        <?php AuthChoice::end(); ?>
    </div>
</div>
<div class="title-bottom col-md-4">
<!--    <h6>ĐÂY LÀ ỨNG DỤNG LƯU TRỮ CÁC DANH MỤC QUẢN TRỊ CỦA TOPICA (VD: DM4C: SP, CDT,…, DANH MỤC NHÂN SỰ: NGẠCH, BẬC,…)</h6>-->
    <p class="no-margin-bottom">Copyright@2018 - <span class="item-title-bottom">SF18.Listmaster</span> - Một sản phẩm của dự án SF18</p>
</div>