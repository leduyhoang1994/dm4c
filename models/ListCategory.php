<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "list_category".
 *
 * @property string $id
 * @property string $category_id
 * @property string $list_id
 * @property string $name
 * @property string $description
 * @property string $owner
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 */
class ListCategory extends \yii\db\ActiveRecord
{

    const CDT = 1;
    const SP = 2;
    const PT = 3;
    const HD = 4;
    const COA = 5;
    const MDT = 6;

    const SPECIAL_LIST = 1;
    const COMMON_LIST = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'list_id', 'owner', 'active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 512],
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
            'list_id' => 'List ID',
            'name' => 'Name',
            'description' => 'Description',
            'owner' => 'Owner',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
