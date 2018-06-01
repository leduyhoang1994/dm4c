<?php
namespace app\models;

use yii\base\Model;

class EntityAccountSearch extends Model 
{
    public $id;
    public $level;
    public $name_en;
    public $parent_id;
    public $full_code;
    public $abbr_code;
    public $abbr_name;
    public $tax_code;
    public $address_in_country;
    public $address_in_english;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'full_code', 'abbr_code', 'name_native', 'name_en', 'abbr_name', 'tax_code', 'address_in_country', 'address_in_english', 'latest_effective_date'], 'required'],
            [['id', 'parent_id', 'level'], 'integer'],
            [['latest_effective_date', 'created_at', 'updated_at'], 'safe'],
            [['full_code', 'abbr_code', 'tax_code'], 'string', 'max' => 32],
            [['name_native', 'name_en', 'abbr_name'], 'string', 'max' => 255],
            [['address_in_country', 'address_in_english'], 'string', 'max' => 300],
        ];
    }
}