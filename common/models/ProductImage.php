<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_image".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $image
 * @property int|null $sort_order
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'image'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['product_id', 'sort_order'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'image' => Yii::t('app', 'Image'),
            'sort_order' => Yii::t('app', 'Sort Order'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

}
