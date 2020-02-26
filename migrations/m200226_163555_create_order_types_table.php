<?php

use yii\db\Migration;
use yii\db\Schema;

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
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
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
