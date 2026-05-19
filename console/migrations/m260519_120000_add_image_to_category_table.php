<?php

use yii\db\Migration;

class m260519_120000_add_image_to_category_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'image', $this->string(255)->null()->after('slug'));
    }

    public function safeDown()
    {
        $this->dropColumn('category', 'image');
    }
}
