<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_version".
 *
 * @property string $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $version_id
 * @property int $owner
 * @property string $created_at
 * @property string $updated_at
 * @property string $record_id
 */
class DataVersion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_version';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'owner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description', 'record_id'], 'string', 'max' => 255],
            [['version_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'version_id' => 'Version ID',
            'owner' => 'Owner',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'record_id' => 'Record ID',
        ];
    }
}
