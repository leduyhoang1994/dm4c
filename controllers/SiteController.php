<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'auth' => [
                'class' => '\app\components\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->title = "List Master project";
        if (!Yii::$app->user->isGuest) {
            // $this->redirect(['/dashboard']);
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'].'/dashboard';
            $url = $protocol.$domainName;
            
            $this->layout = 'login';

            return $this->redirect(['/dashboard/login-handle',
                'email' => Yii::$app->user->identity->email,
                'auth_key' => Yii::$app->user->identity->auth_key
            ]);

            return $this->render('redirect', [
                'url' => $url
            ]);

            if (Yii::$app->user->identity->role_id == \app\models\Role::ADMINISTRATOR) {
                $this->redirect(['/dashboard']);
            }
            if (Yii::$app->user->identity->role_id == \app\models\Role::GUEST || Yii::$app->user->identity->role_id == \app\models\Role::EDITOR) {
                $this->redirect(['/dashboard']);
            }
            $confirmed = Yii::$app->user->identity->request_identity == null;
            if (Yii::$app->user->identity->role_id == \app\models\Role::DEVELOPER) {
                $this->layout = "none";
            }
            return $this->render('index-user',[
                'confirmed' => $confirmed
            ]);
        } else {
            $this->redirect(['/site/login']);
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Register action
     *
     * @return view
     */
    public function actionRegister()
    {
        $this->layout = 'login';
        $model = new \app\models\forms\RegisterForm;
        $params = Yii::$app->request->bodyParams;

        if ($model->load($params, "RegisterForm")) {
            if (!$model->validate()) {
                echo \yii\helpers\Html::errorSummary($model);
            }
            else {
                $user = $model->register();
                if ($user) {
                    Yii::$app->user->login($user, 3600 * 24);
                    Yii::$app->session->setFlash('success', 'Your request has been sent, please contact to admin of List Master to confirm your request');
                    $this->redirect(['/']);
                }
            }
        }

        return $this->render('register',[
            'model' => $model
        ]);
    }

    public function actionAdminLogin()
    {
        $model = new \app\models\LoginForm;

        $params = Yii::$app->request->bodyParams;
        if ($model->load($params, "LoginForm") && $model->validate()) {
            if($model->login()){
                return $this->goHome();
            }
        }
        return $this->render('login',[
            'model' => $model
        ]);
    }

    /**
     * auth handle
     */
    public function onAuthSuccess($client)
    {
        (new \app\components\AuthHandler($client))->handle();
    }
}
