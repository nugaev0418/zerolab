<?php

namespace common\models;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "category".
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
 * @property int|null $parent_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Category[] $categories
 * @property Category $parent
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'name_uz', 'name_ru', 'name_en', 'description_uz', 'description_ru', 'description_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en', 'parent_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['description_uz', 'description_ru', 'description_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en'], 'string'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'name_uz', 'name_ru', 'name_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public static function getTreeList($parentId = null, $level = 0)
    {
        $data = [];
        $categories = self::find()
            ->where(['parent_id' => $parentId])
            ->orderBy(['id' => SORT_ASC])
            ->all();

        foreach ($categories as $category) {
            $data[$category->id] = str_repeat('— ', $level) . $category->name_uz;
            $data += self::getTreeList($category->id, $level + 1);
        }

        return $data;
    }

    public function getName()
    {
        $lang = Yii::$app->language;

        return $this->{'name_' . $lang} ?? $this->name_uz;
    }

}
