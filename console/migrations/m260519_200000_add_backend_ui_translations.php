<?php

use yii\db\Migration;

class m260519_200000_add_backend_ui_translations extends Migration
{
    private array $translations = [
        // layout — sidebar menu
        'Dashboard'     => ['uz' => "Bosh sahifa",          'ru' => "Главная"],
        'Settings'      => ['uz' => "Sozlamalar",            'ru' => "Настройки"],
        'Categories'    => ['uz' => "Kategoriyalar",         'ru' => "Категории"],
        'Directions'    => ['uz' => "Yo'nalishlar",          'ru' => "Направления"],
        'Products'      => ['uz' => "Mahsulotlar",           'ru' => "Товары"],
        'Brands'        => ['uz' => "Brendlar",              'ru' => "Бренды"],
        'Messages'      => ['uz' => "Xabarlar",              'ru' => "Сообщения"],
        'Sources'       => ['uz' => "Manbalar",              'ru' => "Источники"],
        // layout — other UI
        'Main'          => ['uz' => "Asosiy",                'ru' => "Основное"],
        'Go to site'    => ['uz' => "Saytga o'tish",         'ru' => "На сайт"],
        'Logout'        => ['uz' => "Chiqish",               'ru' => "Выход"],
        // dashboard — stat cards
        'Quick links'   => ['uz' => "Tez havolalar",         'ru' => "Быстрые ссылки"],
        'Add Product'   => ['uz' => "Mahsulot qo'shish",    'ru' => "Добавить товар"],
        'Add Category'  => ['uz' => "Kategoriya qo'shish",  'ru' => "Добавить категорию"],
        'Add Direction' => ['uz' => "Yo'nalish qo'shish",   'ru' => "Добавить направление"],
        'Add Brand'     => ['uz' => "Brend qo'shish",       'ru' => "Добавить бренд"],
        'Information'   => ['uz' => "Ma'lumot",              'ru' => "Информация"],
        'Site'          => ['uz' => "Sayt",                  'ru' => "Сайт"],
        'Date'          => ['uz' => "Sana",                  'ru' => "Дата"],
        'Admin'         => ['uz' => "Admin",                 'ru' => "Администратор"],
    ];

    public function up(): void
    {
        foreach ($this->translations as $key => $langs) {
            $row = (new \yii\db\Query())
                ->from('source_message')
                ->where(['category' => 'app', 'message' => $key])
                ->one($this->db);

            if (!$row) {
                $this->insert('source_message', ['category' => 'app', 'message' => $key]);
                $id = $this->db->lastInsertID;
            } else {
                $id = $row['id'];
            }

            foreach ($langs as $lang => $translation) {
                $exists = (new \yii\db\Query())
                    ->from('message')
                    ->where(['id' => $id, 'language' => $lang])
                    ->exists($this->db);

                if (!$exists) {
                    $this->insert('message', [
                        'id'          => $id,
                        'language'    => $lang,
                        'translation' => $translation,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        foreach (array_keys($this->translations) as $key) {
            $row = (new \yii\db\Query())
                ->from('source_message')
                ->where(['category' => 'app', 'message' => $key])
                ->one($this->db);

            if ($row) {
                $this->delete('message', ['id' => $row['id']]);
                $this->delete('source_message', ['id' => $row['id']]);
            }
        }
    }
}
