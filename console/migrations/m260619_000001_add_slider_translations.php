<?php

use yii\db\Migration;

class m260619_000001_add_slider_translations extends Migration
{
    private array $translations = [
        'Sliders'      => ['uz' => "Slayderlar",           'ru' => "Слайдеры"],
        'Create Slider'=> ['uz' => "Slayder yaratish",     'ru' => "Создать слайдер"],
        'Update Slider'=> ['uz' => "Slayderni tahrirlash", 'ru' => "Редактировать слайдер"],
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
