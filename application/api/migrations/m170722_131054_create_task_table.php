<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `task`.
 */
class m170722_131054_create_task_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable(
            'task', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT ,
            'due_date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'assigned_to' => Schema::TYPE_INTEGER . ' NOT NULL',
            'submitted_at' => Schema::TYPE_DATETIME ,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('task');
    }
}
