<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * SetRoleForm
 */
class SetRoleForm extends Model
{
    public $userId;
    public $role;

    private $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['role', 'userId'], 'required'],
            ['userId', 'validateUser'],
            ['role', 'exist', 'targetClass' => \app\models\Role::class, 'targetAttribute' => ['role' => 'id']],
        ];
    }

    public function validateUser($attribute)
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
        $this->_user = $this->_user === false ? \app\models\User::findOne($this->userId) : $this->_user;

        return $this->_user;
    }

    public function setRole()
    {
        $user = $this->getUser();

        $user->role_id = $this->role;
        $user->request_identity = null;
        $user->token = \app\models\User::generateToken();
        $result = [];
        
        if($user->save()){
            $result['result'] = true;
            $result['token'] = $user->token;
        } else {
            $result['result'] = false;
        }

        return $result;
    }
}
