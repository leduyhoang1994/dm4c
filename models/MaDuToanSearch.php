<?php
namespace app\models;

use yii\base\Model;

class MaDuToanSearch extends Model
{
    public $id;
    public $id_bpms;
    public $mdt;
    public $name;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new MaDuToan())->rules();
    }
}