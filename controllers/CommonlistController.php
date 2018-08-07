<?php

namespace app\controllers;

use app\models\CommonlistType;
use Yii;
use app\models\Commonlist;
use app\components\Helper;

class CommonlistController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Commonlist';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

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
            'authenticator' => [
                'class' => \yii\filters\auth\CompositeAuth::className(),
                'authMethods' => [
                    \yii\filters\auth\HttpBearerAuth::className(),
                ],
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex($slug)
    {
        $query = Commonlist::find()->joinWith(['commonlistType'])->where([
            'commonlist.active' => 1,
            'slug' => $slug,
            'commonlisttype.active' => 1
        ]);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function actionSearch($slug)
    {
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\CommonlistSearch'
        ]);

        $filterCondition = null;
        if (isset(Yii::$app->request->getBodyParams()['filter']) && $filter->load(Yii::$app->request->getBodyParams())) {
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }

        $query = \app\models\Commonlist::find()->joinWith(['commonlistType'])->where([
            'commonlist.active' => 1,
            'slug' => $slug,
            'commonlisttype.active' => 1
        ]);
        $filterStr = json_encode($filterCondition);
        $filterStr = str_replace('"id":','"commonlist.id":',$filterStr);
        $filterStr = str_replace('"name":','"commonlist.name":',$filterStr);
        $filterStr = str_replace('"description":','"commonlist.description":',$filterStr);
        $filterCondition = json_decode($filterStr, true);

        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }

//        return $query->createCommand()->sql;

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
