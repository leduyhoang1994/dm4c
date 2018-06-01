<?php
namespace app\models;

use yii\base\Model;

class ProductSearch extends Model 
{
    public $id;
    public $level;
    public $product_name_vn;
    public $product_name_en;
    public $complete_code;
    public $parent_id;
    public $shortened_code;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'acitve', 'product_name_vn', 'product_name_en', 'complete_code', 'shortened_code', 'payment_outside', 'payment_inside'], 'required'],
            [['id', 'parent_id', 'level', 'acitve', 'payment_outside', 'payment_inside'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name_vn', 'product_name_en'], 'string', 'max' => 255],
            [['complete_code', 'shortened_code'], 'string', 'max' => 32],
        ];
    }
}