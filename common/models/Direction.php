<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property string|null $slug
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property string|null $description_uz
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $meta_title_uz
 * @property string|null $meta_title_ru
 * @property string|null $meta_title_en
 * @property string|null $meta_description_uz
 * @property string|null $meta_description_ru
 * @property string|null $meta_description_en
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product[] $products
 */
class Direction extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'direction';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \common\components\SlugBehavior::class,
                'attribute' => 'name_uz',
                'slugAttribute' => 'slug',
            ],
            \yii\behaviors\TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['slug', 'name_uz', 'name_ru', 'name_en', 'description_uz', 'description_ru', 'description_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['description_uz', 'description_ru', 'description_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'name_uz', 'name_ru', 'name_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_en' => Yii::t('app', 'Name En'),
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_en' => Yii::t('app', 'Description En'),
            'meta_title_uz' => Yii::t('app', 'Meta Title Uz'),
            'meta_title_ru' => Yii::t('app', 'Meta Title Ru'),
            'meta_title_en' => Yii::t('app', 'Meta Title En'),
            'meta_description_uz' => Yii::t('app', 'Meta Description Uz'),
            'meta_description_ru' => Yii::t('app', 'Meta Description Ru'),
            'meta_description_en' => Yii::t('app', 'Meta Description En'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['direction_id' => 'id']);
    }

    public static function getList()
    {
        $data = [];
        $directions = self::find()->orderBy(['id' => SORT_ASC])->all();
        foreach ($directions as $direction) {
            $data[$direction->id] = $direction->name_uz;
        }
        return $data;
    }

    public function getName()
    {
        $lang = Yii::$app->language;
        return $this->{'name_' . $lang} ?? $this->name_uz;
    }
}
