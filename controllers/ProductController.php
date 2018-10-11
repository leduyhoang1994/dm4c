<?php

namespace app\controllers;

use app\models\ListCategory;
use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;
use app\components\Helper;

class ProductController extends ActiveController implements Dm4cController
{
    public $modelClass = 'app\models\Product';

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

    public function actionSearch()
    {
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\ProductSearch'
        ]);
        
        $filterCondition = null;
        
        // You may load filters from any source. For example,
        // if you prefer JSON in request body,
        // use Yii::$app->request->getBodyParams() below:
        if (isset(Yii::$app->request->getBodyParams()['filter']) && $filter->load(Yii::$app->request->getBodyParams())) {
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }

        $catId = \app\models\ListCategory::find()->where([
            "category_id" => 1,
            "list_id" => ListCategory::SP
        ])->one()->id;

        $query = \app\models\Product::find()->select(['sp.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < sp.updated_at, 
            concat(SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1), '+'), 
            SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1))
            from version where id = (select version_id from data_version where category_id = {$catId} order by version_id desc limit 1)) as version"]);
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }

        $provider = [
            'query' => $query,
        ];

        if (isset(Yii::$app->request->getBodyParams()['pagination']) && !Yii::$app->request->getBodyParams()['pagination']) {
            $provider['pagination'] = false;
        }

        return new \yii\data\ActiveDataProvider($provider);
    }

    public function actionIndex()
    {
        $catId = \app\models\ListCategory::find()->where([
            "category_id" => 1,
            "list_id" => ListCategory::SP
        ])->one()->id;

        $query = \app\models\Product::find()->select(['sp.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < sp.updated_at, 
            concat(SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1), '+'), 
            SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1))
            from version where id = (select version_id from data_version where category_id = {$catId} order by version_id desc limit 1)) as version"]);

        $provider = [
            'query' => $query
        ];

        return new \yii\data\ActiveDataProvider($provider);
    }

    public function actionNested() {
        $data = \app\models\Product::find()->asArray()->all();
        $tree = Helper::buildTree($data);
        return new \yii\data\ArrayDataProvider([
            'allModels' => $tree,
        ]);
    }
}