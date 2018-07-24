<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register to DM4C';
?>
<?php $this->beginBlock('myCss') ?>
    <link href="/css/custom/loginform.css" rel="stylesheet">
<?php $this->endBlock() ?>
<div class="col-md-4 col-md-offset-1 form-login">
    <div class="col-md-10 content-login">
        <div class="logo-login">
            <img src="/images/SF18_list_master.png">
        </div>
        <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'login-form'
                ]
        ]); ?>
            <?= $form->field($model, 'email', [
                'template' => '<div class="form-group">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                {input}
                                <div class="validation-message">{error}</div>
                            </div>'
            ])->textInput(['id' => 'email', 'class' => "form-control", 'placeholder' => "Email"]) ?>
            <?= $form->field($model, 'username', [
                'template' => '<div class="form-group">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    {input}
                                    <div class="validation-message">{error}</div>
                                </div>'
            ])->textInput(['id' => 'username', 'class' => "form-control", 'placeholder' => "Username"]) ?>
            <?= $form->field($model, 'password', [
                'template' => '<div class="form-group">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        {input}
                                        <div class="validation-message">{error}</div>
                                    </div>'
            ])->passwordInput(['id' => 'password', 'class' => "form-control", 'placeholder' => "Password"]) ?>
            <?= $form->field($model, 'verifyCode', ['template' => '{input}
                    <div class="validation-message">{error}</div></div>'])->widget(\yii\captcha\Captcha::classname(), [
                'template' => '
                <div class="form-group capcha">
                    <div class="col-md-6 text-capcha">
                        <p>Verification code</p>
                    </div>
                    <div class="col-md-6 capcha-form">
                        {image}
                    </div>
                </div>
                <div class="form-group">
                    {input}',
                'options' => [
                    'placeholder' => 'Enter the code here',
                    'class' => 'form-control'
                ]
            ]) ?>
            <?= Html::submitButton('Sign up', ['class' => 'btn btn-login col-md-12']) ?>
        <?php ActiveForm::end(); ?>
        <div class="tile-login">
            <p>Sign in by Gmail</p>
        </div>
        <div class="button-login">
            <?php use yii\authclient\widgets\AuthChoice; ?>
            <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
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
    <div class="title-bottom col-md-12">
        <!-- <h6>ĐÂY LÀ ỨNG DỤNG LƯU TRỮ CÁC DANH MỤC QUẢN TRỊ CỦA TOPICA (VD: DM4C: SP, CDT,…, DANH MỤC NHÂN SỰ: NGẠCH, BẬC,…)</h6> -->
        <p class="no-margin-bottom">Copyright@2018 - <span class="item-title-bottom">SF18.Listmaster</span> - Một sản phẩm của dự án SF18</p>
    </div>
</div>
