<?php

use yii\db\Migration;

class m250301_000007_create_product_review_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product_review}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),

            'full_name' => $this->string(),
            'phone' => $this->string(50),

            'rating' => $this->tinyInteger()->defaultValue(5),
            'review' => $this->text(),

            'status' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_review_product',
            '{{%product_review}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_review}}');
    }
}