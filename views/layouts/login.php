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
    <link href="/css/font-awesome.css" rel="stylesheet">


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
</head>
<body>

<div class="main-container">
    <div class="main-body">
        <?php $this->beginBody() ?>
    </div>
</div>

<?= $content ?>
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
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
