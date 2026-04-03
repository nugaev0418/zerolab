<?php

use yii\db\Migration;

class m250301_000002_create_slider_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),

            'title_uz' => $this->string(),
            'title_ru' => $this->string(),
            'title_en' => $this->string(),

            'text_uz' => $this->text(),
            'text_ru' => $this->text(),
            'text_en' => $this->text(),

            'image' => $this->string(),
            'url' => $this->string(),

            'sort_order' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger(1)->defaultValue(1),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}