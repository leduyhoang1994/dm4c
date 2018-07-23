<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cdt".
 *
 * @property string $id
 * @property string $parent_id
 * @property int $level
 * @property string $division_name_vn
 * @property string $division_name_en
 * @property string $complete_code
 * @property string $shortened_code
 * @property string $proposal
 * @property string $approved
 * @property string $link_pdf
 * @property string $decision_number
 * @property string $upgrade_note
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class CostProfit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cdt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'decision_number', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['division_name_vn', 'division_name_en', 'link_pdf'], 'string', 'max' => 255],
            [['complete_code', 'shortened_code', 'proposal', 'approved'], 'string', 'max' => 32],
            [['upgrade_note'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'level' => Yii::t('app', 'Level'),
            'division_name_vn' => Yii::t('app', 'Division Name Vn'),
            'division_name_en' => Yii::t('app', 'Division Name En'),
            'complete_code' => Yii::t('app', 'Complete Code'),
            'shortened_code' => Yii::t('app', 'Shortened Code'),
            'proposal' => Yii::t('app', 'Proposal'),
            'approved' => Yii::t('app', 'Approved'),
            'link_pdf' => Yii::t('app', 'Link Pdf'),
            'decision_number' => Yii::t('app', 'Decision Number'),
            'upgrade_note' => Yii::t('app', 'Upgrade Note'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
