<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;

class ProductController extends ActiveController implements Dm4cController
{
    public $modelClass = 'app\models\Product';

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

    public function actionSearch()
    {
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\ProductSearch'
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
        
        $query = \app\models\Product::find();
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
        
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }
}