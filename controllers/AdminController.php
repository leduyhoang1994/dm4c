<?php

namespace app\controllers;

use app\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AdminController extends Controller
{
    public $defaultAction = 'index';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'confirm', 'partner-manager', 'remove-test'],
                'ruleConfig' => [
                    'class' => \app\components\filter\AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'confirm', 'partner-manager', 'remove-test'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Set quyền cho user
     * @param $u request_identity của user
     * @return string|void
     */
    public function actionConfirm($u)
    {
        $user = \app\models\User::findOne([
            'request_identity' => $u
        ]);
        if (!$user) {
            echo $this->render('/site/message', [
                'message' => \yii\helpers\Html::label("Request invalid")
            ]);
            exit;
        }

        $model = new \app\models\forms\SetRoleForm;

        if ($model->load(Yii::$app->request->bodyParams, "SetRoleForm")) {
            if (!$model->validate()) {
                echo \yii\helpers\Html::errorSummary($model);
            }
            else
            { 
                $setRole = $model->setRole();
                if ($setRole['result']) {
                    echo "<p class=\"lead\"><center>Success !!!</center></p>";
                    return;
                }
            }
        }

        $roles = \yii\helpers\ArrayHelper::map(\app\models\Role::find()->all(), 'id', 'name');

        if (empty($user)) {
            echo "Access denied, your session has been expired";
            exit();
        }

        return $this->render("set-role", [
            'requestIdentity' => $u,
            'model' => $model,
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Hiển thị màn hình nhúng phân quyền
     * @return string
     */
    public function actionPartnerManager()
    {
        $this->layout = 'none';
        $model = new \app\models\forms\SetRoleForm;
        $roles = \yii\helpers\ArrayHelper::map(\app\models\Role::find()->all(), 'id', 'name');
        $message = [];

        if ($model->load(Yii::$app->request->bodyParams, 'SetRoleForm')) {
            if (!$model->validate()) {
                if ($model->hasErrors()) {
                    $message['status'] = 'error';
                    $message['message'] = $model->getFirstErrors();
                }
            } else {
                if ($model->setRole()) {
                    $message['status'] = 'success';
                    $message['message'] = 'Update success';
                } else {
                    $message['status'] = 'error';
                    $message['message'] = 'Update fail';
                }
            }
        }

        $query = \app\models\User::find()
            ->select('user.id, username, email, role_id')->innerJoinWith('role', true);;


        $userSearch = new UserSearch();

        $query = $userSearch->search($query, Yii::$app->request->queryParams);

        $usersData = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'email' => SORT_DESC,
                    'username' => SORT_ASC, 
                    'role_id' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('partner', [
            'searchModel' => $userSearch,
            'usersData' => $usersData,
            'model' => $model,
            'roles' => $roles,
            'message' => $message
        ]);
    }

    public function actionRemoveTest ($id) {
        $user = \app\models\User::findOne($id);
        if (!empty($user) && \app\components\Helper::startsWith($user->email, Yii::$app->params['testEmail'])) {
            $user->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

}
