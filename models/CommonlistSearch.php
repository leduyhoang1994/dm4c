<?php
namespace app\models;

use yii\base\Model;

class CommonlistSearch extends Model
{
    public $id;
    public $parent_id;
    public $listtype_id;
    public $name;
    public $description;
    public $active;
    public $owner;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new Commonlist())->rules();
    }
}