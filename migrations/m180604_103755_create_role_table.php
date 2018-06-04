<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role`.
 */
class m180604_103755_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        
        $this->addForeignKey('fk-user-role_id-role-id', 'user', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');

        $this->insert('role', [
            'id' => 1,
            'name' => 'Guest',
        ]);
        $this->insert('role', [
            'id' => 2,
            'name' => 'Administrator',
        ]);
        $this->insert('role', [
            'id' => 3,
            'name' => 'Developer',
        ]);
        $this->insert('role', [
            'id' => 4,
            'name' => 'Editor',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('role');
    }
}
