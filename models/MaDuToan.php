<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "madutoan".
 *
 * @property string $id
 * @property string $id_bpms
 * @property string $mdt
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class MaDuToan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'madutoan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['id_bpms', 'mdt'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bpms' => 'Id Bpms',
            'mdt' => 'Mdt',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
