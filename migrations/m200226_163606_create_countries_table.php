<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%countriess}}`.
 */
class m200226_163606_create_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey()->unsigned(),
            'code' => $this->string(2)->unique(),
            'name' =>$this->string(45)->notNull()
        ]);

        $this->batchInsert('countries', ['code', 'name'], [
            ['Ng', 'Nigeria'], ['Ca', 'Canada'], ['Us', 'United States'], ['Mx', 'Mexico']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%countries}}');
    }
}
