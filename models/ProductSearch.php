<?php
namespace app\models;

use yii\base\Model;

class ProductSearch extends Model 
{
    public $parent_id;
    public $level;
    public $product_name_vn;
    public $product_name_en;
    public $complete_code;
    public $shortened_code;
    public $payment_outside;
    public $payment_inside;
    public $status;
    public $created_at;
    public $updated_at;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new Product)->rules();
    }
}