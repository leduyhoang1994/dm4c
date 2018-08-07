<?php
use app\models\User;
use cakebake\actionlog\model\ActionLog;
return function ($event) {
    $listControllerLog = [
        'cdt_list',
        'pt_list',
        'sp_list',
        'hd_list',
        'common_list'
    ];

    if (in_array($event->action->controller->id, $listControllerLog)) {
        ActionLog::add(Yii::$app->response->statusCode, [
            "url" => Yii::$app->request->url,
            "params" => Yii::$app->request->bodyParams,
        ]);
    }
};
