<?php
use app\models\User;
use app\models\ApiToken;
use cakebake\actionlog\model\ActionLog;
return function ($event) {
    $authKey = $_COOKIE['_identity'] ?? null;

    $listControllerLog = [
        'cdt_list',
        'pt_list',
        'sp_list',
        'hd_list',
    ];
    $identity = ApiToken::find()->where(['token' => $authKey, 'status'=>1])->one();
    if (Yii::$app->user->isGuest && !empty($authKey)) {
        if ($identity) {
            $user = User::find()->where('email', $identity->user_email)->one();
            Yii::$app->user->login($user, 3600 * 24);
        }
    }
    if ($identity) {
        if (in_array($event->action->controller->id, $listControllerLog)) {
            ActionLog::add("success", [
                "url" => Yii::$app->request->url,
                "params" => Yii::$app->request->bodyParams,
                "app_id" => $identity->app_id,
            ]);
        }
    }

};
