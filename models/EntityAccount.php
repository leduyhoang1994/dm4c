<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pt".
 *
 * @property string $id
 * @property string $parent_id
 * @property int $level
 * @property string $name_native
 * @property string $short_name
 * @property string $name_en
 * @property string $complete_code
 * @property string $short_code
 * @property string $tax_code
 * @property string $location
 * @property string $address_in_country
 * @property string $address_in_english
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class EntityAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name_native', 'short_name', 'name_en'], 'string', 'max' => 255],
            [['complete_code', 'short_code', 'tax_code', 'location'], 'string', 'max' => 32],
            [['address_in_country', 'address_in_english'], 'string', 'max' => 300],
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
            'name_native' => Yii::t('app', 'Name Native'),
            'short_name' => Yii::t('app', 'Short Name'),
            'name_en' => Yii::t('app', 'Name En'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'short_code' => Yii::t('app', 'Short Code'),
            'tax_code' => Yii::t('app', 'Tax Code'),
            'location' => Yii::t('app', 'Location'),
            'address_in_country' => Yii::t('app', 'Address In Country'),
            'address_in_english' => Yii::t('app', 'Address In English'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
