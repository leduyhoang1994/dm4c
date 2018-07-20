<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-md-6 col-md-offset-3">
    <img src="<?= Yii::$app->request->baseUrl.'/images/SF18_Madata_logo.png' ?>" alt="" width="100%" height="auto">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
    
        <div class="row">
            <?= $form->field($model, 'email', [
                'template' => '<div class="input-field col col-md-12 col-xs-12">
                        <i class="material-icons prefix">account_circle</i>
                        {input}
                        <label for="email">{label}</label>
                    </div><div class="col-xs-12">{error}</div>'
            ])->textInput(['id' => 'email']) ?>

            <?= $form->field($model, 'password', [
                'template' => '<div class="input-field col col-md-12 col-xs-12">
                        <i class="material-icons prefix">security</i>
                        {input}
                        <label for="password">{label}</label>
                    </div><div class="col-xs-12">{error}</div>',
            ])->passwordInput(['id' => 'password']) ?>
        </div>

        <div class="row">
            <div class="col-md-6 text-center align-middle forgot">
                <a class="dm4c-a disabled" data-toggle="tooltip" title="Comming soon!" href="#">Forgot your password?</a>
            </div>
            <div class="col-md-6 text-center">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary bg-madata', 'name' => 'login-button']) ?>
                <!-- <a class="btn btn-success" href="/site/register">Register</a> -->
            </div>
        </div>

        <div class="row">
            <div class="col col-md-12 text-center col-xs-12" style="margin-top: 10px">
                <?php use yii\authclient\widgets\AuthChoice; ?>
                <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <?php
                        echo $authAuthChoice->clientLink($client,
                        '<i class="fa fa-google-plus"></i> Login with Google',
                        [
                            'class' => 'btn-social btn-google-plus',
                        ])
                    ?>
                <?php endforeach; ?>
                <?php AuthChoice::end(); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col col-md-12">
                <div class="radius-box text-center">
                    You don't have an account? <a class="dm4c-a" href="/site/register">Register now!</a>
                </div>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>
</div>
<script>
</script>