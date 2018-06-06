<?php

namespace app\controllers;

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
                'only' => ['index', 'confirm', 'partner-manager'],
                'rules' => [
                    [
                        'actions' => ['index', 'confirm', 'partner-manager'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
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

    public function beforeAction($action) {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role_id !== \app\models\Role::ADMINISTRATOR) {

            if (Yii::$app->user->isGuest) {
                return $this->redirect(['site/register']);
            }

            echo $this->render('/site/message', [
                'message' => 'Access denied'
            ]);
            exit;
        }

        return parent::beforeAction($action);
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
                    Yii::$app->mailer->compose('submitSuccess', [
                        'token' => $setRole['token'],
                    ])
                        ->setFrom('dm4c@topica.asia')
                        ->setTo($user->email)
                        ->setSubject('Submit registration for DM4C services')
                        ->send();
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

    public function actionPartnerManager()
    {
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
            ->select('id, username, email, role_id')
            ->with('role');

        $usersData = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
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
            'usersData' => $usersData,
            'model' => $model,
            'roles' => $roles,
            'message' => $message
        ]);
    }

}
