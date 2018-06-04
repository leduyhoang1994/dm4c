<?php

use yii\db\Migration;

/**
 * Handles adding token to table `user`.
 */
class m180601_105746_add_token_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'token', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'token');
    }
}
