<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_types}}`.
 */
class m200226_163555_create_order_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_types}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' =>$this->string(45)->notNull(),
        ]);

        $this->batchInsert('order_types', ['name'], [
            ['Delivery'], ['Servicing'], ['Installation']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_types}}');
    }
}
