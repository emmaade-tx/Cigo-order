<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%countriess}}`.
 */
class m200226_163606_create_countriess_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%countriess}}', [
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%countriess}}');
    }
}
