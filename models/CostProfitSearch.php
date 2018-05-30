<?php
namespace app\models;

use yii\base\Model;

class CostProfitSearch extends Model 
{
    public $id;
    public $level;
    public $division_name_vn;
    public $parent_id;
    public $shortened_code;
    
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['level', 'integer', 'min' => 0, 'max' => 5],
            ['division_name_vn', 'string'],
            ['parent_id', 'integer'],
            ['shortened_code', 'string']
        ];
    }
}