<?php
namespace app\components;

use app\models\Auth;
use app\models\User;
use app\components\Helper;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use cakebake\actionlog\model\ActionLog;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $nickname = ArrayHelper::getValue($attributes, 'login');

        if ($this->client->getId() === 'google') {
            $email = ArrayHelper::getValue($attributes, 'emails.0.value');
            $nickname = ArrayHelper::getValue($attributes, 'displayName');
        }

        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();
        if (!Helper::validateEmail($email))
        {
            Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', 'Your email doesnt exist. Please create an account to login!'),
            ]);
            return;
        }

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                /* @var User $user */
                $user = $auth->user;
                Yii::$app->user->login($user, 3600 * 24);
                ActionLog::add('success');
                $message = [
                    'source' => $id,
                    'email' => $email
                ];
//                var_dump($message);exit();
            } else { // signup
                if ($email !== null && User::find()->where(['email' => $email])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
                    ]);
                } else {
                    $requestIdentity = Yii::$app->security->generateRandomString();
                    $defaultPassword = Yii::$app->params['defaultPassword'];
                    $adminEmail = Yii::$app->params['adminEmail'];

                    $password = Yii::$app->security->generatePasswordHash($defaultPassword);
                    $user = new User([
                        'username' => $nickname,
                        'email' => $email,
                        'password_hash' => $password,
                        'created_at' => time(),
                        'updated_at' => time(),
                        'role_id' => \app\models\Role::GUEST,
                        'request_identity' => $requestIdentity
                    ]);
                    $user->generateAuthKey();
                    // $user->generatePasswordResetToken();

                    $transaction = User::getDb()->beginTransaction();

                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $this->client->getId(),
                            'source_id' => (string)$id,
                        ]);
                        if ($auth->save()) {

                            Helper::registerMail($email, $nickname, $requestIdentity, true);

                            $transaction->commit();
                            Yii::$app->session->setFlash('success', 'Your request has been sent, please contact to admin of List Master to confirm your request');
                            Yii::$app->user->login($user, 3600 * 24);
                            ActionLog::add('register');
                        } else {
                            Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', 'Unable to save {client} account: {errors}', [
                                    'client' => $this->client->getTitle(),
                                    'errors' => json_encode($auth->getErrors()),
                                ]),
                            ]);
                        }
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save user: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($user->getErrors()),
                            ]),
                        ]);
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string)$attributes['id'],
                ]);
                if ($auth->save()) {
                    /** @var User $user */
                    $user = $auth->user;
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', 'Linked {client} account.', [
                            'client' => $this->client->getTitle()
                        ]),
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to link {client} account: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ]),
                    ]);
                }
            } else { // there's existing auth
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app',
                        'Unable to link {client} account. There is another user using it.',
                        ['client' => $this->client->getTitle()]),
                ]);
            }
        }
    }
}