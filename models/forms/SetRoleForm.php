<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * SetRoleForm
 */
class SetRoleForm extends Model
{
    public $requestIdentity;
    public $role;

    private $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['role', 'requestIdentity'], 'required'],
            ['requestIdentity', 'validateEmail'],
            ['role', 'exist', 'targetClass' => \app\models\Role::class, 'targetAttribute' => ['role' => 'id']],
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
        $admin = Yii::$app->user->identity;

        if ($admin->role_id !== \app\models\Role::ADMINISTRATOR) {
            $this->addError("Permission", "You must be Administrator to set role for this user");
            return;
        }

        $user = $this->getUser();
        
        if (!$user) {
            $this->addError($attribute, "User not exist");
            return;
        }
    }

    private function getUser()
    {
        if (ctype_digit($this->requestIdentity)) {
            $this->_user = $this->_user === false ? \app\models\User::findOne($this->requestIdentity) : $this->_user;    
        } else {
            $this->_user = $this->_user === false ? \app\models\User::findByRequestIdentity($this->requestIdentity) : $this->_user;
        }
        

        return $this->_user;
    }

    public function setRole()
    {
        $user = $this->getUser();

        $user->role_id = $this->role;
        $user->request_identity = null;
        $sendMail = false;
        if ($user->token == null) {
            $sendMail = true;
        }
        $user->token = $user->token == null && $user->role_id == \app\models\Role::DEVELOPER ? \app\models\User::generateToken() : $user->token;
        $result = [];
        
        if($user->save()){
            $result['result'] = true;
            $result['token'] = $user->token;

            if ($sendMail) {
                Yii::$app->mailer->compose('submitSuccess', [
                    'token' => $user->token,
                ])
                    ->setFrom('listmaster@topica.asia')
                    ->setTo($user->email)
                    ->setSubject('Submit registration for List Master services')
                    ->send();
            }
        } else {
            $result['result'] = false;
        }

        return $result;
    }
}
