<?php

namespace app\controllers;

use app\models\CommonlistType;
use app\models\ListCategory;
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
        $commonId = CommonlistType::find()->where([
            "slug" => $slug
        ])->one()->id;

        $catId = \app\models\ListCategory::find()->where([
            "category_id" => ListCategory::COMMON_LIST,
            "list_id" => $commonId
        ])->one()->id;

        $query = Commonlist::find()->joinWith(['commonlistType'])->where([
            'commonlist.active' => 1,
            'slug' => $slug,
            'commonlisttype.active' => 2
        ])->select(['commonlist.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < commonlist.updated_at, 
            concat(SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1), '+'), 
            SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1))
            from version where id = (select version_id from data_version where category_id = {$catId} order by version_id desc limit 1)) as version"]);

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


        $commonId = CommonlistType::find()->where([
            "slug" => $slug
        ])->one()->id;

        $catId = \app\models\ListCategory::find()->where([
            "category_id" => ListCategory::COMMON_LIST,
            "list_id" => $commonId
        ])->one()->id;

        $query = Commonlist::find()->joinWith(['commonlistType'])->where([
            'commonlist.active' => 1,
            'slug' => $slug,
            'commonlisttype.active' => 2
        ])->select(['commonlist.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < commonlist.updated_at, 
            concat(SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1), '+'), 
            SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1))
            from version where id = (select version_id from data_version where category_id = {$catId} order by version_id desc limit 1)) as version"]);

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
