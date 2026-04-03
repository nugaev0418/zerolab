<?php

use yii\db\Migration;

class m250301_000006_create_product_image_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'image' => $this->string(),
            'sort_order' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk_product_image_product',
            '{{%product_image}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_image}}');
    }
}