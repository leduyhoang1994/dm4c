<?php
namespace app\models;

use yii\base\Model;

class UserSearch extends User
{
    public $username;
    public $email;
    public $role_id;
    public $roleName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = (new User)->rules();
        $rules[] = [["roleName"], "safe"];
        return array_merge($rules);
    }

    public function search($query, $params) {
        $this->load($params);
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'role.name', $this->roleName]);
        return $query;
    }
}