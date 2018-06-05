<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $email;
    public $username;
    public $password;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'verifyCode'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['email', 'validateEmail'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function validateEmail($attribute)
    {
        if (!empty(\app\models\User::findOne(['email' => $this->$attribute]))) {
            $this->addError($attribute, 'This email has already registered, please contact to admin');
        }
    }

    public function register()
    {
        $passwordHash = \app\models\User::generatePassword($this->password);
        $requestIdentity = Yii::$app->security->generateRandomString();

        $user = new \app\models\User([
            'username' => $this->username,
            'email' => $this->email,
            'password_hash' => $passwordHash,
            'created_at' => time(),
            'updated_at' => time(),
            'role_id' => \app\models\Role::GUEST,
            'request_identity' => $requestIdentity
        ]);
        $user->generateAuthKey();

        $defaultPassword = Yii::$app->params['defaultPassword'];
        $adminEmail = Yii::$app->params['adminEmail'];

        
        Yii::$app->mailer
        ->compose('registerSuccess', [
            'email' => $this->email,
            'link' => Yii::$app->request->hostInfo . yii\helpers\Url::to(['admin/confirm',
            'u' => $requestIdentity])
        ])
        ->setFrom($adminEmail)
        ->setTo($adminEmail)
        ->setSubject('Submit registration for DM4C services')
        ->send();
                            
        Yii::$app->mailer
        ->compose('registerInfo', [
            'name' => $nickname,
            'social' => true,
            'password' => $defaultPassword
        ])
        ->setFrom($adminEmail)
        ->setTo($email)
        ->setSubject('Registation infomation')
        ->send();

        return $user->save();
    }
}
