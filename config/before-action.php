<?php
use app\models\User;

return function ($event) {
    $authKey = $_COOKIE['_identity'] ?? null;

    if (Yii::$app->user->isGuest && $authKey !== null) {
        $identity = User::findByAuthkey($authKey);
        if ($identity) {
            Yii::$app->user->login($identity, 3600 * 24);
        }
    }
};
