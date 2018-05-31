<?php

namespace app\components;

use Yii;

class AuthAction extends \yii\authclient\AuthAction
{
    public $errorUrl = "";

    protected function defaultSuccessUrl()
    {
        if (Yii::$app->session->hasFlash('error')) {
            Yii::$app->getSession()->setFlash('error', [
                Yii::$app->getSession()->getFlash('error')[0]
            ]);
            return \yii\helpers\Url::to(['site/register']);
        }

        return Yii::$app->getUser()->getReturnUrl();
    }
}