<?php
namespace app\models;

use yii\base\Model;

class ActivitySearch extends Model 
{
    public $id;
    public $level;
    public $formula;
    public $title;
    public $complete_code;
    public $parent_id;
    public $shortened_code;
    public $activity_code;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'activity_code', 'title', 'complete_code', 'shortened_code', 'formula', 'define', 'tot', 'toa', 'cf'], 'required'],
            [['parent_id', 'level', 'tot', 'toa', 'cf'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['activity_code', 'complete_code', 'shortened_code'], 'string', 'max' => 32],
            [['title', 'formula', 'define'], 'string', 'max' => 300],
        ];
    }
}