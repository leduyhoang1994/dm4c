<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pt".
 *
 * @property string $id
 * @property string $parent_id
 * @property int $level
 * @property string $full_code
 * @property string $abbr_code
 * @property string $name_native
 * @property string $name_en
 * @property string $abbr_name
 * @property string $tax_code
 * @property string $address_in_country
 * @property string $address_in_english
 * @property string $latest_effective_date
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
            [['parent_id', 'level', 'full_code', 'abbr_code', 'name_native', 'name_en', 'abbr_name', 'tax_code', 'address_in_country', 'address_in_english', 'latest_effective_date'], 'required'],
            [['parent_id', 'level'], 'integer'],
            [['latest_effective_date', 'created_at', 'updated_at'], 'safe'],
            [['full_code', 'abbr_code', 'tax_code'], 'string', 'max' => 32],
            [['name_native', 'name_en', 'abbr_name'], 'string', 'max' => 255],
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
            'full_code' => Yii::t('app', 'Full Code'),
            'abbr_code' => Yii::t('app', 'Abbr Code'),
            'name_native' => Yii::t('app', 'Name Native'),
            'name_en' => Yii::t('app', 'Name En'),
            'abbr_name' => Yii::t('app', 'Abbr Name'),
            'tax_code' => Yii::t('app', 'Tax Code'),
            'address_in_country' => Yii::t('app', 'Address In Country'),
            'address_in_english' => Yii::t('app', 'Address In English'),
            'latest_effective_date' => Yii::t('app', 'Latest Effective Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
