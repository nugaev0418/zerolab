<?php

use yii\db\Migration;

class m260228_080612_init_setting_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%setting}}', [
            'id',
            'site_name_uz',
            'site_name_ru',
            'site_name_en',
            'about_title_uz',
            'about_title_ru',
            'about_title_en',
            'about_content_uz',
            'about_content_ru',
            'about_content_en',
            'address_uz',
            'address_ru',
            'address_en',
            'phone',
            'email',
            'telegram',
            'instagram',
            'facebook',
            'updated_at'
        ], [
            [
                1,
                '', '', '',
                '', '', '',
                '', '', '',
                '', '', '',
                '', '', '',
                '', '',
                0
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260228_080612_init_setting_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260228_080612_init_setting_data cannot be reverted.\n";

        return false;
    }
    */
}
