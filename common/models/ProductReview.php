<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_review".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $full_name
 * @property string|null $phone
 * @property int|null $rating
 * @property string|null $review
 * @property int|null $status
 * @property int|null $created_at
 *
 * @property Product $product
 */
class ProductReview extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'full_name', 'phone', 'review', 'created_at'], 'default', 'value' => null],
            [['rating'], 'default', 'value' => 5],
            [['status'], 'default', 'value' => 0],
            [['product_id', 'rating', 'status', 'created_at'], 'integer'],
            [['review'], 'string'],
            [['full_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
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
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'rating' => Yii::t('app', 'Rating'),
            'review' => Yii::t('app', 'Review'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
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
