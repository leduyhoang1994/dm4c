<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;
use app\widgets\Alert;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<style>
    .wrap {
        background: url(<?= Yii::$app->request->baseUrl.'/images/bg_login.jpg' ?>);
        background-size: cover;
        z-index: 1;
    }
    .wrap::before { 
        background-color: black;
        content: "";
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%; 
        height: 100%;  
        opacity: .7; 
        z-index: 0;
    }

    .site-login,.user-create,.redirect {
        z-index: 1;
        position: relative;
        margin-top: 10%;
    }

    .redirect {
        color: white;
        height: 300px;
    }

    .bg-madata {
        background-color: #d89f45 !important;
        width: 100%;
    }

    .radius-box {
        padding: 20px 0px;
        margin: 10px 0px;
        background: rgba(51, 51, 51, 0.30980392156862746);
        color: #fff;
    }

    .dm4c-a{
        color: #d89f45;
    }

    .forgot{
        margin-top: 8px;
    }

    .btn-google-plus{
        display: inline-block;
        height: 38px;
        line-height: 38px;
        padding: 0px 16px;
        border-radius: 2px;
        text-decoration: none !important;
        width: 100%;
        font-weight: bold;
        background-color: #d89f45 !important;
    }

    .help-block{
        display: block;
    }

    #w1 {
        width: 100%
    }

    .btn {
        font-weight: bold;
    }

    a.disabled {
        /* Make the disabled links grayish*/
        color: gray;
        /* And disable the pointer events */
        cursor: not-allowed;
        text-decoration: none !important;
        /* pointer-events: none; */
    }

    .bg-madata-black {
        background: #333;
        color : white;
        width: 100%;
    }
</style>

<div class="wrap">
    <div class="hidden">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top hidden',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right hidden'],
            'items' => [
                // ['label' => 'Home', 'url' => ['/site/index']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
                [
                    'label' => 'Partners', 
                    'url' => ['/admin/partner-manager'],
                    'visible' => (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == \app\models\Role::ADMINISTRATOR)
                ],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->email . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>
    </div>

    <div class="container" style="padding-top: 0px">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
