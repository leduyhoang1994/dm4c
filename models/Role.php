<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_role".
 *
 * @property int $id
 * @property string $name
 */
class Role extends \yii\db\ActiveRecord
{
    const GUEST = 1;
    const DEVELOPER = 3;
    const ADMINISTRATOR = 2;
    const EDITOR = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
