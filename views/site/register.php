<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register to DM4C';
?>
<div class="user-create">
    <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::classname(), [
            'options' => [
                'label' => 'Enter captcha code'
            ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
        
            <?php use yii\authclient\widgets\AuthChoice; ?>
            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php
                    echo $authAuthChoice->clientLink($client,
                    '<i class="fa fa-google-plus"></i> Sign in with Google',
                    [
                        'class' => 'btn btn-social btn-google-plus',
                    ])
                ?>
            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
