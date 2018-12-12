<?php

namespace app\controllers;

use app\models\ListCategory;
use Yii;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;
use app\components\Helper;
/* Controller quản lý việc gọi api cho chiều Hoạt Động */
class ActivitieController extends ActiveController implements Dm4cController
{
    public $modelClass = 'app\models\Activity';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
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
            'authenticator' => [
                'class' => \yii\filters\auth\CompositeAuth::className(),
                'authMethods' => [
                    \yii\filters\auth\HttpBearerAuth::className(),
                ],
            ],
        ];
    }

    public function actionSearch()
    {
        // api tìm kiếm
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\ActivitySearch'
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
            "list_id" => ListCategory::HD
        ])->one()->id;

        // đoạn raw query để lấy thêm version của hđ
        $query = \app\models\Activity::find()->select(['hd.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < hd.updated_at, 
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
        // hiển thị dữ liệu
        $catId = \app\models\ListCategory::find()->where([
            "category_id" => 1,
            "list_id" => ListCategory::HD
        ])->one()->id;

        // đoạn raw query để lấy thêm version của hđ
        $query = \app\models\Activity::find()->select(['hd.*',"(select 
            if ((select updated_at from data_version where category_id = 1 order by version_id desc limit 1) < hd.updated_at, 
            concat(SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1), '+'), 
            SUBSTRING_INDEX(SUBSTRING_INDEX(name , ' - ', 1), ' - ', -1))
            from version where id = (select version_id from data_version where category_id = {$catId} order by version_id desc limit 1)) as version"]);

        $provider = [
            'query' => $query
        ];

        return new \yii\data\ActiveDataProvider($provider);
    }

    public function actionNested() {
        $data = \app\models\Activity::find()->asArray()->all();
        $tree = Helper::buildTree($data);
        return new \yii\data\ArrayDataProvider([
            'allModels' => $tree,
        ]);
    }
}