<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%good_category}}`.
 */
class m221023_213601_create_good_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%good_category}}', [
            'id' => $this->primaryKey(),
            'good_id' => $this->bigInteger()->notNull(),
            'category_id' => $this->bigInteger()->notNull(),
        ]);

        $this->createIndex('idx-good_category-good_id', '{{%good_category}}', 'good_id');
        $this->createIndex('idx-good_category-category_id', '{{%good_category}}', 'category_id');
        $this->createIndex('idx-good_category-good_id-category_id', '{{%good_category}}', ['good_id', 'category_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-good_category-good_id-category_id', '{{%good_category}}');
        $this->dropIndex('idx-good_category-category_id', '{{%good_category}}');
        $this->dropIndex('idx-good_category-good_id', '{{%good_category}}');

        $this->dropTable('{{%good_category}}');
    }
}
