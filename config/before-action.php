<?php
use app\models\User;

return function ($event) {
    $authKey = $_COOKIE['_identity'] ?? null;
    
    if (Yii::$app->user->isGuest && !empty($authKey)) {
        $identity = User::findByAuthkey($authKey);
        if ($identity) {
            Yii::$app->user->login($identity, 3600 * 24);
        }
    }
};
