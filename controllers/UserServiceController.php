<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;

class UserServiceController extends ActiveController
{
    public $modelClass = 'app\models\User';
    
    public function behaviors()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionLogin() {
        $params = Yii::$app->request->bodyParams;
        $model = new \app\models\LoginForm;
        
        $result = [];

        if (!$model->load($params, '')) {
            throw new \yii\web\BadRequestHttpException(Yii::t("app", "Invalid form format"));
        }

        if (!$model->validate()) {
            $result['result'] = "FAIL";
            $result['code'] = 400;
            $result['message'] = "Login fail";
            $result['errors'] = $model->errors;

            return $result;
        }

        $user = $model->getUser();

        $result['result'] = "OK";
        $result['code'] = 200;
        $result['message'] = "Login successfully";
        $result['email'] = $user->email;
        $result['role'] = $user->role->name;
        $result['role_id'] = $user->role->id;

        return $result;
    }
}