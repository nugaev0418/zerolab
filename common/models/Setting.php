<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string|null $site_name_uz
 * @property string|null $site_name_ru
 * @property string|null $site_name_en
 * @property string|null $about_title_uz
 * @property string|null $about_title_ru
 * @property string|null $about_title_en
 * @property string|null $about_content_uz
 * @property string|null $about_content_ru
 * @property string|null $about_content_en
 * @property string|null $address_uz
 * @property string|null $address_ru
 * @property string|null $address_en
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $facebook
 * @property int|null $updated_at
 */
class Setting extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_name_uz', 'site_name_ru', 'site_name_en', 'about_title_uz', 'about_title_ru', 'about_title_en', 'about_content_uz', 'about_content_ru', 'about_content_en', 'address_uz', 'address_ru', 'address_en', 'phone', 'email', 'telegram', 'instagram', 'facebook', 'updated_at'], 'default', 'value' => null],
            [['about_content_uz', 'about_content_ru', 'about_content_en', 'address_uz', 'address_ru', 'address_en'], 'string'],
            [['updated_at'], 'integer'],
            [['site_name_uz', 'site_name_ru', 'site_name_en', 'about_title_uz', 'about_title_ru', 'about_title_en'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['email', 'telegram', 'instagram', 'facebook'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_name_uz' => Yii::t('app', 'Site Name Uz'),
            'site_name_ru' => Yii::t('app', 'Site Name Ru'),
            'site_name_en' => Yii::t('app', 'Site Name En'),
            'about_title_uz' => Yii::t('app', 'About Title Uz'),
            'about_title_ru' => Yii::t('app', 'About Title Ru'),
            'about_title_en' => Yii::t('app', 'About Title En'),
            'about_content_uz' => Yii::t('app', 'About Content Uz'),
            'about_content_ru' => Yii::t('app', 'About Content Ru'),
            'about_content_en' => Yii::t('app', 'About Content En'),
            'address_uz' => Yii::t('app', 'Address Uz'),
            'address_ru' => Yii::t('app', 'Address Ru'),
            'address_en' => Yii::t('app', 'Address En'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'telegram' => Yii::t('app', 'Telegram'),
            'instagram' => Yii::t('app', 'Instagram'),
            'facebook' => Yii::t('app', 'Facebook'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function getOne()
    {
        return self::findOne(1);
    }


    public static function get($key, $default = null)
    {
        $setting = self::find()->one();

        if (!$setting) {
            return $default;
        }

        // 1. oddiy field (phone, email)
        if (isset($setting->$key) && !empty($setting->$key)) {
            return $setting->$key;
        }

        // 2. multilanguage field
        $lang = substr(\Yii::$app->language, 0, 2);
        $column = $key . '_' . $lang;

        if (isset($setting->$column) && !empty($setting->$column)) {
            return $setting->$column;
        }

        // 3. fallback uz
        $fallback = $key . '_uz';

        return $setting->$fallback ?? $default;
    }
}
