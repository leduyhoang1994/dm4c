<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hd".
 *
 * @property string $id
 * @property string $parent_id
 * @property int $level
 * @property string $name
 * @property string $body
 * @property string $complete_code
 * @property string $shortened_code
 * @property string $formula
 * @property string $define
 * @property int $tot
 * @property int $toa
 * @property int $cf
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'tot', 'toa', 'cf', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'complete_code', 'shortened_code'], 'string', 'max' => 32],
            [['body', 'formula', 'define'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'level' => Yii::t('app', 'Level'),
            'name' => Yii::t('app', 'Name'),
            'body' => Yii::t('app', 'Body'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'shortened_code' => Yii::t('app', 'Shortened Code'),
            'formula' => Yii::t('app', 'Formula'),
            'define' => Yii::t('app', 'Define'),
            'tot' => Yii::t('app', 'Tot'),
            'toa' => Yii::t('app', 'Toa'),
            'cf' => Yii::t('app', 'Cf'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
