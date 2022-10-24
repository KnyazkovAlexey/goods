<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%goods}}`.
 */
class m221023_205309_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'cost' => $this->float()->notNull(),
            'quantity' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx_goods_name', '{{%goods}}', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_goods_name', '{{%goods}}');

        $this->dropTable('{{%goods}}');
    }
}
