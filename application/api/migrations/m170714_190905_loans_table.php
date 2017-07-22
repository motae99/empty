<?php

use yii\db\Migration;
use yii\db\Schema;


class m170714_190905_loans_table extends Migration
{
    public function up()
    {
        $this->createTable('loan', [
            'id' => $this->primaryKey(),
            'amount' => $this->money()->notNull(),
            'purpose' => $this->string()->notNull(),
            'deb_from' => $this->string()->notNull(),
            'date' => $this->date()->notNull(),
            'created_at' => $this->timestamp(),
            'created_by' => $this->integer()->null(),
            'updated_by' => $this->integer()->null(),
            'updated_at' => $this->datetime()->null(),
            'status' => $this->string()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('loan');
    }
}
