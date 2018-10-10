<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sp".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $level
 * @property string $product_name_vn
 * @property string $product_name_en
 * @property string $complete_code
 * @property string $shortened_code
 * @property int $payment_outside
 * @property int $payment_inside
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'payment_outside', 'payment_inside', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name_vn', 'product_name_en'], 'string', 'max' => 255],
            [['complete_code', 'shortened_code'], 'string', 'max' => 32],
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
            'product_name_vn' => Yii::t('app', 'Product Name Vn'),
            'product_name_en' => Yii::t('app', 'Product Name En'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'shortened_code' => Yii::t('app', 'Shortened Code'),
            'payment_outside' => Yii::t('app', 'Payment Outside'),
            'payment_inside' => Yii::t('app', 'Payment Inside'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function attributes()
    {
        // add distance attribute (will work for json output)
        return array_merge(parent::attributes(), ['version']);
    }
}
