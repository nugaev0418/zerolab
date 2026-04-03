<?php

use yii\db\Migration;

class m250301_000004_create_brand_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%brand}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->unique(),

            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'name_en' => $this->string(),

            'logo' => $this->string(),
            'website' => $this->string(),

            'meta_title_uz' => $this->string(),
            'meta_title_ru' => $this->string(),
            'meta_title_en' => $this->string(),

            'meta_description_uz' => $this->text(),
            'meta_description_ru' => $this->text(),
            'meta_description_en' => $this->text(),

            'status' => $this->tinyInteger(1)->defaultValue(1),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%brand}}');
    }
}