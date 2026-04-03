<?php

namespace common\models;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property string|null $catalog_number
 * @property string|null $short_description_uz
 * @property string|null $short_description_ru
 * @property string|null $short_description_en
 * @property string|null $description_uz
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $meta_title_uz
 * @property string|null $meta_title_ru
 * @property string|null $meta_title_en
 * @property string|null $meta_description_uz
 * @property string|null $meta_description_ru
 * @property string|null $meta_description_en
 * @property string|null $image
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Brand $brand
 * @property Category $category
 * @property ProductImage[] $productImages
 * @property ProductReview[] $productReviews
 */
class Product extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public $imageFile;

    public $galleryFiles;

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
            [['slug', 'category_id', 'brand_id', 'name_uz', 'name_ru', 'name_en', 'catalog_number', 'short_description_uz', 'short_description_ru', 'short_description_en', 'description_uz', 'description_ru', 'description_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en', 'image', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['category_id', 'brand_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['short_description_uz', 'short_description_ru', 'short_description_en', 'description_uz', 'description_ru', 'description_en', 'meta_description_uz', 'meta_description_ru', 'meta_description_en'], 'string'],
            [['slug', 'name_uz', 'name_ru', 'name_en', 'meta_title_uz', 'meta_title_ru', 'meta_title_en', 'image'], 'string', 'max' => 255],
            [['catalog_number'], 'string', 'max' => 150],
            [['slug'], 'unique'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['brand_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,webp'],
            [['galleryFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,webp', 'maxFiles' => 10],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'name_en' => Yii::t('app', 'Name En'),
            'catalog_number' => Yii::t('app', 'Catalog Number'),
            'short_description_uz' => Yii::t('app', 'Short Description Uz'),
            'short_description_ru' => Yii::t('app', 'Short Description Ru'),
            'short_description_en' => Yii::t('app', 'Short Description En'),
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_en' => Yii::t('app', 'Description En'),
            'meta_title_uz' => Yii::t('app', 'Meta Title Uz'),
            'meta_title_ru' => Yii::t('app', 'Meta Title Ru'),
            'meta_title_en' => Yii::t('app', 'Meta Title En'),
            'meta_description_uz' => Yii::t('app', 'Meta Description Uz'),
            'meta_description_ru' => Yii::t('app', 'Meta Description Ru'),
            'meta_description_en' => Yii::t('app', 'Meta Description En'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id'])
            ->orderBy(['sort_order' => SORT_ASC]);
    }

    public function getMainImage()
    {
        return $this->hasOne(ProductImage::class, ['product_id' => 'id'])
            ->orderBy(['id' => SORT_ASC]);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(ProductReview::class, ['product_id' => 'id']);
    }

    public function getName()
    {
        $lang = Yii::$app->language;
        return $this->{'name_' . $lang} ?? $this->name_uz;
    }

    public function getDescription()
    {
        $lang = Yii::$app->language;
        return $this->{'description_' . $lang} ?? $this->description_uz;
    }

}
