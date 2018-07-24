<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register to DM4C';
?>
<div class="user-create col-md-6 col-md-offset-3">
        <img src="<?= Yii::$app->request->baseUrl.'/images/SF18_Madata_logo.png' ?>" alt="" width="100%" height="auto">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <?= $form->field($model, 'email', [
                'template' => '<div class="input-field col col-md-12 col-xs-12">
                        <i class="material-icons prefix">email</i>
                        {input}
                        <label for="email">{label}</label>
                    </div><div class="col-xs-12">{error}</div>'
            ])->textInput(['id' => 'email']) ?>

            <?= $form->field($model, 'username', [
                'template' => '<div class="input-field col col-md-12 col-xs-12">
                        <i class="material-icons prefix">account_circle</i>
                        {input}
                        <label for="username">{label}</label>
                    </div><div class="col-xs-12">{error}</div>',
            ])->textInput(['id' => 'username']) ?>

            <?= $form->field($model, 'password', [
                'template' => '<div class="input-field col col-md-12 col-xs-12">
                        <i class="material-icons prefix">security</i>
                        {input}
                        <label for="password">{label}</label>
                    </div><div class="col-xs-12">{error}</div>',
            ])->passwordInput(['id' => 'password']) ?>
        </div>

        <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::classname(), [
            'options' => [
                'label' => 'Enter captcha code'
            ]
        ]) ?>

        <div class="row text-center">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary bg-madata-black']) ?>
            <div class="col-md-12" style="color: #fff; padding: 10px 0px">
                -Or-
            </div>
            <?php use yii\authclient\widgets\AuthChoice; ?>
            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php
                    echo $authAuthChoice->clientLink($client,
                    '<i class="fa fa-google-plus"></i> Register with Google',
                    [
                        'class' => 'btn-social btn-google-plus',
                    ])
                ?>
            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
