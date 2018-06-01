<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;

class CostProfitController extends ActiveController implements Dm4cController
{
    public $modelClass = 'app\models\CostProfit';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * @inheritDoc
     */
    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

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

    public function actionSearch()
    {
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\CostProfitSearch'
        ]);
        
        $filterCondition = null;
        
        // You may load filters from any source. For example,
        // if you prefer JSON in request body,
        // use Yii::$app->request->getBodyParams() below:
        if ($filter->load(Yii::$app->request->getBodyParams())) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }
        
        $query = \app\models\CostProfit::find();
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
        
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }
}