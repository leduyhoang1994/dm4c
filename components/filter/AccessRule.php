<?php
namespace app\components\filter;

class AccessRule extends \yii\filters\AccessRule 
{
    /**
     * @inheritdoc
     * */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if (\Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!\Yii::$app->user->isGuest) {
                    return true;
                }
            } elseif ($role === 'admin') {
                if (!\Yii::$app->user->isGuest && \Yii::$app->user->identity->role_id == \app\models\Role::ADMINISTRATOR) {
                    return true;
                }
            } elseif ($user->can($role)) {
                return true;
            }
        }
        return false;
    }
}