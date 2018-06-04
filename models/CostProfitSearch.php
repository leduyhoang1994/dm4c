<?php
namespace app\models;

use yii\base\Model;

class CostProfitSearch extends Model 
{
    public $parent_id;
    public $level;
    public $division_name_vn;
    public $division_name_en;
    public $complete_code;
    public $shortened_code;
    public $proposal;
    public $approved;
    public $link_pdf;
    public $decision_number;
    public $upgrade_note;
    public $status;
    public $created_at;
    public $updated_at;

    public function rules()
    {
        return (new CostProfit)->rules();
    }
}