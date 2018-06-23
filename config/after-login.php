<?php

return function () 
{
    $val =  Yii::$app->user->identity->auth_key;
    
    // Yii::$app->response->cookies->add(new yii\web\Cookie([
    //     'name' => '_identity',
    //     'value' => $val,
    // ]));

    setcookie('_identity', $val, time() + (86400 * 30), "/");
};