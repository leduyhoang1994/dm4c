<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\components\Helper;

/**
 * RegisterForm is the model behind the contact form.
 */
class CustomMailForm extends Model
{
    public $subject;
    public $content;
    public $to = null;
    public $ccAdmins = true;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['subject', 'content'], 'required'],
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

    public function send()
    {
        return Helper::sendMail($this->subject, $this->content, $this->to, $this->ccAdmins);
    }
}
