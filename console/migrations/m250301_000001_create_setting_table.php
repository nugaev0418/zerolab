<?php

use yii\db\Migration;

class m250301_000001_create_setting_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),

            'site_name_uz' => $this->string(),
            'site_name_ru' => $this->string(),
            'site_name_en' => $this->string(),

            'about_title_uz' => $this->string(),
            'about_title_ru' => $this->string(),
            'about_title_en' => $this->string(),

            'about_content_uz' => $this->text(),
            'about_content_ru' => $this->text(),
            'about_content_en' => $this->text(),

            'address_uz' => $this->text(),
            'address_ru' => $this->text(),
            'address_en' => $this->text(),

            'phone' => $this->string(50),
            'email' => $this->string(150),
            'telegram' => $this->string(150),

            'instagram' => $this->string(150),
            'facebook' => $this->string(150),

            'updated_at' => $this->integer()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}