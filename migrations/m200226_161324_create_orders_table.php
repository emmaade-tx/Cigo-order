<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m200226_161324_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => 'pk',
            'first_name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'phone_number' => Schema::TYPE_STRING . ' NOT NULL',
            'order_type_id' => Schema::TYPE_TINYINT . ' NOT NULL',
            'order_value' => Schema::TYPE_STRING,
            'scheduled_date' => Schema::TYPE_STRING  . ' NOT NULL',
            'address' => Schema::TYPE_TEXT  . ' NOT NULL',
            'city' => Schema::TYPE_TEXT  . ' NOT NULL',
            'state' => Schema::TYPE_STRING  . ' NOT NULL',
            'zip_code' => Schema::TYPE_STRING,
            'country_id' => Schema::TYPE_TINYINT . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
