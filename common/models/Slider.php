<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string|null $text_uz
 * @property string|null $text_ru
 * @property string|null $text_en
 * @property string|null $image
 * @property string|null $url
 * @property int|null $sort_order
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Slider extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'title_ru', 'title_en', 'text_uz', 'text_ru', 'text_en', 'image', 'url', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['sort_order'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['text_uz', 'text_ru', 'text_en'], 'string'],
            [['sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title_uz', 'title_ru', 'title_en', 'image', 'url'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'jpg, png, jpeg, webp', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_uz' => Yii::t('app', 'Title Uz'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_en' => Yii::t('app', 'Title En'),
            'text_uz' => Yii::t('app', 'Text Uz'),
            'text_ru' => Yii::t('app', 'Text Ru'),
            'text_en' => Yii::t('app', 'Text En'),
            'image' => Yii::t('app', 'Image'),
            'url' => Yii::t('app', 'Url'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function upload()
    {
        if ($this->imageFile) {

            $uploadPath = Yii::getAlias('@frontend') . '/web/upload/slider/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }



            $fileName = uniqid() . '.' . $this->imageFile->extension;
            $path = 'upload/slider/' . $fileName;

            if ($this->imageFile->saveAs($uploadPath . $fileName)) {
                $this->image = $fileName;
                return true;
            }
        }

        return false;
    }

    public function getTitle()
    {
        $lang = Yii::$app->language;
        return $this->{'title_' . $lang} ?? $this->title_uz;
    }

    public function getText()
    {
        $lang = Yii::$app->language;
        return $this->{'text_' . $lang} ?? $this->text_uz;
    }

}
