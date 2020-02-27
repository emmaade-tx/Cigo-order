<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statusses}}`.
 */
class m200227_081838_create_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statuses}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' =>$this->string(45)->notNull()
        ]);

        $this->batchInsert('statuses', ['name'], [
            ['Pending'], ['Assigned'], ['On Route'], ['Done'], ['Cancelled']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statuses}}');
    }
}
