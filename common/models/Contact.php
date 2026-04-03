<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $full_name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $message
 * @property int|null $status
 * @property int|null $created_at
 */
class Contact extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone', 'email', 'message', 'created_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['message'], 'string'],
            [['status', 'created_at'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

}
