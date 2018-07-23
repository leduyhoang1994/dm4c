<?php
namespace app\models;

use yii\base\Model;

class EntityAccountSearch extends Model 
{
    public $id;
    public $parent_id;
    public $level;
    public $name_native;
    public $short_name;
    public $name_en;
    public $complete_code;
    public $short_code;
    public $tax_code;
    public $location;
    public $address_in_country;
    public $address_in_english;
    public $status;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new EntityAccount)->rules();
    }
}