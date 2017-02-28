<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property string $brand_id
 * @property string $brand_name
 * @property string $pinyin
 * @property string $logo
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_del
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'is_del'], 'integer'],
            [['brand_name'], 'string', 'max' => 30],
            [['pinyin'], 'string', 'max' => 200],
            [['logo'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'pinyin' => 'Pinyin',
            'logo' => 'Logo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_del' => 'Is Del',
        ];
    }
}
