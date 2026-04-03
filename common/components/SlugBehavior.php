<?php

namespace common\components;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

class SlugBehavior extends AttributeBehavior
{
    public $attribute = 'name_uz';
    public $slugAttribute = 'slug';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'generateSlug',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'generateSlugIfEmpty',
        ];
    }

    public function generateSlugIfEmpty()
    {
        if (empty($this->owner->{$this->slugAttribute})) {
            $this->generateSlug();
        }
    }

    public function generateSlug()
    {
        $model = $this->owner;

        // Agar slug mavjud bo'lsa update paytida o'zgartirmaymiz
        if (!empty($model->{$this->slugAttribute})) {
            return;
        }

        $baseSlug = Inflector::slug($model->{$this->attribute}) ?: 'item';
        $slug = $baseSlug;
        $i = 1;

        $query = $model::find();

        // Agar update bo'lsa o'zini hisobga olmaymiz
        if (!$model->isNewRecord) {
            $query->andWhere(['not', ['id' => $model->id]]);
        }

        while ($query->andWhere([$this->slugAttribute => $slug])->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $model->{$this->slugAttribute} = $slug;
    }
}