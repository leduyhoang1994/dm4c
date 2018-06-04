<?php
namespace app\models;

use yii\base\Model;

class ActivitySearch extends Model 
{
    public $parent_id;
    public $level;
    public $name;
    public $body;
    public $complete_code;
    public $shortened_code;
    public $formula;
    public $define;
    public $tot;
    public $toa;
    public $cf;
    public $status;
    public $created_at;
    public $updated_at;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new Activity)->rules();
    }
}