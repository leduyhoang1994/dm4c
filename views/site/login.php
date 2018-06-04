<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php use yii\authclient\widgets\AuthChoice; ?>
    <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
    <?php foreach ($authAuthChoice->getClients() as $client): ?>
        <?php
            echo $authAuthChoice->clientLink($client,
            '<i class="fa fa-google-plus"></i> Login with Google',
            [
                'class' => 'btn btn-social btn-google-plus',
            ])
        ?>
    <?php endforeach; ?>
    <?php AuthChoice::end(); ?>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'type' => 'email']) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <a class="btn btn-success" href="/site/register">Register</a>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>
</div>
