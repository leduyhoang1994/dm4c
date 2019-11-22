<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commonlist".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $listtype_id
 * @property string $name
 * @property string $description
 * @property int $active
 * @property string $owner
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ListType $listtype
 * @property ListMasterHistory[] $listMasterHistories
 */
class ApiToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token_api';
    }


}
