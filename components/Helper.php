<?php
namespace app\components;

use Yii;
use app\models\User;
use app\models\Role;

class Helper
{
    public static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return $length === 0 || 
        (substr($haystack, -$length) === $needle);
    }

    public static function validateEmail($email) {
        if (!Helper::endswith($email, '@topica.edu.vn') 
                && !Helper::endswith($email, '@topica.asia')
                    && !Helper::startsWith($email, Yii::$app->params['testEmail'])) {
            return false;
        }

        return true;
    }

    public static function registerMail ($email, $username, $requestIdentity, $social) {
        $adminEmail = Yii::$app->params['adminEmail'];

        $selectAdmin = User::find()->select('email')->where(['role_id' => Role::ADMINISTRATOR])->asArray()->all();
        $adminEmails = array_column($selectAdmin, 'email');

        $mailer = Yii::$app->mailer
        ->compose('registerSuccess', [
            'email' => $email,
            'link' => Yii::$app->request->hostInfo . \yii\helpers\Url::to(['admin/confirm',
            'u' => $requestIdentity])
        ])
        ->setFrom($adminEmail)
        ->setTo($adminEmail);

        if (!Helper::startsWith($email, Yii::$app->params['testEmail'])) {
            $mailer->setCC($adminEmails);
        }

        $mailer->setSubject('Submit registration for DM4C services')
        ->send();
                            
        Yii::$app->mailer
        ->compose('registerInfo', [
            'name' => $username,
            'social' => false
        ])
        ->setFrom($adminEmail)
        ->setTo($email)->setSubject('Registation infomation')
        ->send();
    }
}