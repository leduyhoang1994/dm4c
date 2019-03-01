<?php
/**
 * Created by PhpStorm.
 * User: Phat Vu
 * Date: 3/1/2019
 * Time: 10:39 AM
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use app\models\forms\LoginForm;
use app\components\Helper;

/**
 * Controller quản lý xuất api các app
 *
 * Class CostProfitController
 * @package app\controllers
 */

class AppListController extends ActiveController implements Dm4cController
{
    public $modelClass = 'app\models\App';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
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

    public function actionNested()
    {
        // TODO: Implement actionNested() method.
    }


    public function actionSearch()
    {
        $filter = new \yii\data\ActiveDataFilter([
            'searchModel' => 'app\models\AppSearch'
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
        $query = \app\models\App::find();
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }

        $provider = [
            'query' => $query,
        ];

        if (isset(Yii::$app->request->getBodyParams()['pagination']) && !Yii::$app->request->getBodyParams()['pagination']) {
            $provider['pagination'] = false;
        }

        return new ActiveDataProvider($provider);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Hiển thị dữ liệu của các app
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex()
    {
        $result = \app\models\App::find();

        return new ActiveDataProvider([
            "query" => $result
        ]);
    }

}