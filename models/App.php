<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app".
 *
 * @property string $id
 * @property string $app_name
 * @property string $app_link
 * @property string $description
 * @property int $app_type
 * @property int $sp_id
 * @property string $link_icon
 * @property string $ga_tracking_code
 * @property int $adder
 * @property int $owner
 * @property int $is_default_app
 * @property int $tech_backend
 * @property int $tech_frontend
 * @property int $infrastructure
 * @property int $is_critical_system
 * @property int $has_t99
 * @property int $has_oar
 * @property int $has_ct5
 * @property int $has_http_access_log
 * @property string $start_date
 * @property int $is_active
 * @property int $sal_level
 * @property int $order
 * @property string $created_at
 * @property string $updated_at
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['app_type', 'sp_id', 'adder', 'owner', 'is_default_app', 'tech_backend', 'tech_frontend', 'infrastructure', 'is_critical_system', 'has_t99', 'has_oar', 'has_ct5', 'has_http_access_log', 'is_active', 'sal_level', 'order'], 'integer'],
            [['start_date', 'created_at', 'updated_at'], 'safe'],
            [['app_name'], 'string', 'max' => 128],
            [['app_link', 'link_icon', 'ga_tracking_code'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_name' => 'App Name',
            'app_link' => 'App Link',
            'description' => 'Description',
            'app_type' => 'App Type',
            'sp_id' => 'Sp ID',
            'link_icon' => 'Link Icon',
            'ga_tracking_code' => 'Ga Tracking Code',
            'adder' => 'Adder',
            'owner' => 'Owner',
            'is_default_app' => 'Is Default App',
            'tech_backend' => 'Tech Backend',
            'tech_frontend' => 'Tech Frontend',
            'infrastructure' => 'Infrastructure',
            'is_critical_system' => 'Is Critical System',
            'has_t99' => 'Has T99',
            'has_oar' => 'Has Oar',
            'has_ct5' => 'Has Ct5',
            'has_http_access_log' => 'Has Http Access Log',
            'start_date' => 'Start Date',
            'is_active' => 'Is Active',
            'sal_level' => 'Sal Level',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
