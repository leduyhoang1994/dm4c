<?php
use app\models\User;
use app\models\ApiToken;
use cakebake\actionlog\model\ActionLog;

function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

return function ($event) {
    $authKey = $_COOKIE['_identity'] ?? null;

    $bearerToken = getBearerToken();

    $listControllerLog = [
        'cdt_list',
        'pt_list',
        'sp_list',
        'hd_list',
    ];

    if (Yii::$app->user->isGuest && !empty($authKey)) {
        $identity = User::findByAuthkey($authKey);
        if ($identity) {
            Yii::$app->user->login($identity, 3600 * 24);
        }
    }

    $token = ApiToken::find()->where(['token' => $bearerToken, 'status'=>1])->one();

    if (in_array($event->action->controller->id, $listControllerLog)) {
        ActionLog::add("success", [
            "url" => Yii::$app->request->url,
            "params" => Yii::$app->request->bodyParams,
            "app_id" => $token->app_id,
        ]);
    }

};
