<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
    <?= empty($this->blocks['myCss']) ? "" : $this->blocks['myCss']; ?>
    <style>
        .validation-message {
            color: red;
            position: absolute;
        }
        #w1{
            width: 100%;
        }
        .main-container{
            background-image: url(/images/bg_login.jpg);
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
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="main-container">
    <div class="main-body">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
<?php
    $status = "";
    $message = "";
    if (Yii::$app->session->hasFlash('success')):
        $status = "success";
        $message = Yii::$app->session->getFlash('success');
    endif;
    if (Yii::$app->session->hasFlash('error')):
        $message = Yii::$app->session->getFlash('error');
        $status = "danger";
    endif;
    if (Yii::$app->session->hasFlash('info')):
        $message = Yii::$app->session->getFlash('info');
        $status = "info";
    endif;

    if ($status !== "") {
        ?>
        <script>makeAlert('Notification', '<?= $message ?>', '<?= $status ?>');</script>
        <?php
    }
?>
</body>
</html>
<?php $this->endPage() ?>
