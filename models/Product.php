<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sp".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $level
 * @property int $acitve
 * @property string $product_name_vn
 * @property string $product_name_en
 * @property string $complete_code
 * @property string $shortened_code
 * @property int $payment_outside
 * @property int $payment_inside
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
            [['parent_id', 'level', 'acitve', 'product_name_vn', 'product_name_en', 'complete_code', 'shortened_code', 'payment_outside', 'payment_inside'], 'required'],
            [['parent_id', 'level', 'acitve', 'payment_outside', 'payment_inside'], 'integer'],
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
            'acitve' => Yii::t('app', 'Acitve'),
            'product_name_vn' => Yii::t('app', 'Product Name Vn'),
            'product_name_en' => Yii::t('app', 'Product Name En'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'shortened_code' => Yii::t('app', 'Shortened Code'),
            'payment_outside' => Yii::t('app', 'Payment Outside'),
            'payment_inside' => Yii::t('app', 'Payment Inside'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
