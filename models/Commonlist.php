<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commonlist".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $listtype_id
 * @property string $name
 * @property string $description
 * @property int $active
 * @property string $owner
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ListType $listtype
 * @property ListMasterHistory[] $listMasterHistories
 */
class Commonlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commonlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'listtype_id', 'active', 'owner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 256],
            [['listtype_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommonlistType::className(), 'targetAttribute' => ['listtype_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'listtype_id' => 'Listtype ID',
            'name' => 'Name',
            'description' => 'Description',
            'active' => 'Active',
            'owner' => 'Owner',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonlistType()
    {
        return $this->hasOne(CommonlistType::className(), ['id' => 'listtype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListMasterHistories()
    {
        return $this->hasMany(ListMasterHistory::className(), ['listmaster_id' => 'id']);
    }

    public function attributes()
    {
        // add distance attribute (will work for json output)
        return array_merge(parent::attributes(), ['version']);
    }
}
