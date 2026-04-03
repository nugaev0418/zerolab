<?php

use yii\db\Migration;

class m250301_000005_create_product_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->unique(),

            'category_id' => $this->integer(),
            'brand_id' => $this->integer()->null(),

            'name_uz' => $this->string(),
            'name_ru' => $this->string(),
            'name_en' => $this->string(),

            'catalog_number' => $this->string(150)->null(),

            'short_description_uz' => $this->text(),
            'short_description_ru' => $this->text(),
            'short_description_en' => $this->text(),

            'description_uz' => $this->text(),
            'description_ru' => $this->text(),
            'description_en' => $this->text(),

            'meta_title_uz' => $this->string(),
            'meta_title_ru' => $this->string(),
            'meta_title_en' => $this->string(),

            'meta_description_uz' => $this->text(),
            'meta_description_ru' => $this->text(),
            'meta_description_en' => $this->text(),

            'image' => $this->string(),

            'status' => $this->tinyInteger(1)->defaultValue(1),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_product_category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk_product_brand',
            '{{%product}}',
            'brand_id',
            '{{%brand}}',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}