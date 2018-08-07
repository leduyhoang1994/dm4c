<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commonlisttype".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Commonlist[] $commonlists
 * @property CommonlisttypeHistory[] $commonlisttypeHistories
 */
class CommonlistType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commonlisttype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['description', 'slug'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'slug' => 'Slug',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonlists()
    {
        return $this->hasMany(Commonlist::className(), ['listtype_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonlisttypeHistories()
    {
        return $this->hasMany(CommonlisttypeHistory::className(), ['listtype_id' => 'id']);
    }
}
