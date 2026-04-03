<?php

use yii\db\Migration;

class m250301_000008_create_contact_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(),
            'phone' => $this->string(50),
            'email' => $this->string(150),
            'message' => $this->text(),
            'status' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}