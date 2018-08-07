<?php
use app\models\User;
use cakebake\actionlog\model\ActionLog;
return function ($event) {
    $authKey = $_COOKIE['_identity'] ?? null;

    $listControllerLog = [
        'cdt_list',
        'pt_list',
        'sp_list',
        'hd_list',
    ];

    if (in_array($event->action->controller->id, $listControllerLog)) {
        ActionLog::add("success", [
            "url" => Yii::$app->request->url,
            "params" => Yii::$app->request->bodyParams
        ]);
    }

    
    if (Yii::$app->user->isGuest && !empty($authKey)) {
        $identity = User::findByAuthkey($authKey);
        if ($identity) {
            Yii::$app->user->login($identity, 3600 * 24);
        }
    }
};
