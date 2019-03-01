<?php
/**
 * Created by PhpStorm.
 * User: Phat Vu
 * Date: 3/1/2019
 * Time: 11:50 AM
 */

namespace app\models;

use yii\base\Model;


class AppSearch extends Model
{
    public $id;
    public $app_name;
    public $app_link;
    public $description;
    public $app_type;
    public $sp_id;
    public $link_icon;
    public $ga_tracking_code;
    public $adder;
    public $owner;
    public $is_default_app;
    public $tech_backend;
    public $tech_frontend;
    public $infrastructure;
    public $is_critical_system;
    public $has_t99;
    public $has_oar;
    public $has_ct5;
    public $has_http_access_log;
    public $start_date;
    public $is_active;
    public $sal_level;
    public $order;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (new App)->rules();
    }
}