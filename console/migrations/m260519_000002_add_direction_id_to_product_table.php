<?php

use yii\db\Migration;

class m260519_000002_add_direction_id_to_product_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'direction_id', $this->integer()->null()->after('brand_id'));

        $this->addForeignKey(
            'fk_product_direction',
            '{{%product}}',
            'direction_id',
            '{{%direction}}',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_product_direction', '{{%product}}');
        $this->dropColumn('{{%product}}', 'direction_id');
    }
}
