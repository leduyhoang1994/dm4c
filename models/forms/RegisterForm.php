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
    public $name;
    public $password;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'verifyCode'], 'required'],
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
        $user = new \app\models\User;
        $user->email = $this->email;
        $user->name = $this->name;
        $passwordHash = \app\models\User::generatePassword($this->password);
        $user->password = $passwordHash;

        return $user->save();
    }
}
