<?php

use yii\db\Migration;

/**
 * Handles adding request_identity to table `user`.
 */
class m180601_110233_add_request_identity_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'request_identity', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'request_identity');
    }
}
