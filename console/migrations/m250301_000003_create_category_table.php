<?php

use yii\db\Migration;

class m250301_000003_create_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->unique(),

            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'name_en' => $this->string(),

            'description_uz' => $this->text(),
            'description_ru' => $this->text(),
            'description_en' => $this->text(),

            'meta_title_uz' => $this->string(),
            'meta_title_ru' => $this->string(),
            'meta_title_en' => $this->string(),

            'meta_description_uz' => $this->text(),
            'meta_description_ru' => $this->text(),
            'meta_description_en' => $this->text(),

            'parent_id' => $this->integer(),
            'status' => $this->tinyInteger(1)->defaultValue(1),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_category_parent',
            '{{%category}}',
            'parent_id',
            '{{%category}}',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}