<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hd".
 *
 * @property string $id
 * @property string $parent_id
 * @property int $level
 * @property string $activity_code
 * @property string $title
 * @property string $complete_code
 * @property string $shortened_code
 * @property string $formula
 * @property string $define
 * @property int $tot
 * @property int $toa
 * @property int $cf
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
            [['parent_id', 'level', 'activity_code', 'title', 'complete_code', 'shortened_code', 'formula', 'define', 'tot', 'toa', 'cf'], 'required'],
            [['parent_id', 'level', 'tot', 'toa', 'cf'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['activity_code', 'complete_code', 'shortened_code'], 'string', 'max' => 32],
            [['title', 'formula', 'define'], 'string', 'max' => 300],
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
            'activity_code' => Yii::t('app', 'Activity Code'),
            'title' => Yii::t('app', 'Title'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'shortened_code' => Yii::t('app', 'Shortened Code'),
            'formula' => Yii::t('app', 'Formula'),
            'define' => Yii::t('app', 'Define'),
            'tot' => Yii::t('app', 'Tot'),
            'toa' => Yii::t('app', 'Toa'),
            'cf' => Yii::t('app', 'Cf'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
