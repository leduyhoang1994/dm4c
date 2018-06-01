<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;

class EntityAccountController extends ActiveController
{
    public $modelClass = 'app\models\EntityAccount';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
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
}