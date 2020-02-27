<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tests}}`.
 */
class m200227_192929_create_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey()->unsigned(),
            'first_name' => $this->string(80)->notNull(),
            'last_name' => $this->string(80),
            'email' => $this->string(80),
            'phone_number' => $this->string(45)->notNull(),
            'order_type_id' => $this->integer()->unsigned()->notNull(),
            'order_value' =>$this->string(45),
            'scheduled_date' => $this->string(45)->notNull(),
            'address' => $this->string(45)->notNull(),
            'city' => $this->string(45)->notNull(),
            'state' => $this->string(45)->notNull(),
            'status_id' => $this->integer()->unsigned()->notNull(),
            'zip_code' =>$this->string(45),
            'country_id' => $this->integer()->unsigned()->notNull(),
            'lat' => $this->string(45)->notNull(),
            'lng' => $this->string(45)->notNull()
        ]);

        $this->addForeignKey('fk_tests_order_type_id_order_types', 'tests', 'order_type_id', 'order_types', 'id');
        $this->addForeignKey('fk_tests_country_id_countries', 'tests', 'country_id', 'countries', 'id');
        $this->addForeignKey('fk_tests_status_id_statuses', 'tests', 'status_id', 'statuses', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tests_order_type_id_order_types', 'tests');
        $this->dropForeignKey('fk_tests_country_id_countries', 'tests');
        $this->dropForeignKey('fk_tests_status_id_statuses', 'tests');
        $this->dropTable('{{%tests}}');
    }
}
