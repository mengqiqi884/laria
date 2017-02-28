<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mer_merchant".
 *
 * @property string $mer_id
 * @property integer $login_id
 * @property string $header_name
 * @property string $header_phone
 * @property string $header_positive_ID
 * @property string $header_opposite_ID
 * @property string $mer_name
 * @property string $address
 * @property integer $city
 * @property string $lng
 * @property string $lat
 * @property string $business_pic
 * @property string $descript
 * @property string $logo
 * @property string $pics
 * @property string $identification_code
 * @property string $reason
 * @property string $technology
 * @property integer $state
 * @property string $servicetime
 * @property string $servicerange
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_del
 */
class MerMerchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mer_merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_id', 'city', 'state', 'is_del'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['header_name', 'reason'], 'string', 'max' => 100],
            [['header_phone'], 'string', 'max' => 11],
            [['header_positive_ID', 'header_opposite_ID', 'lng', 'lat', 'business_pic'], 'string', 'max' => 200],
            [['mer_name', 'identification_code'], 'string', 'max' => 50],
            [['address', 'descript', 'logo', 'pics', 'servicetime', 'servicerange'], 'string', 'max' => 500],
            [['technology'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mer_id' => 'Mer ID',
            'login_id' => 'Login ID',
            'header_name' => 'Header Name',
            'header_phone' => 'Header Phone',
            'header_positive_ID' => 'Header Positive  ID',
            'header_opposite_ID' => 'Header Opposite  ID',
            'mer_name' => 'Mer Name',
            'address' => 'Address',
            'city' => 'City',
            'lng' => 'Lng',
            'lat' => 'Lat',
            'business_pic' => 'Business Pic',
            'descript' => 'Descript',
            'logo' => 'Logo',
            'pics' => 'Pics',
            'identification_code' => 'Identification Code',
            'reason' => 'Reason',
            'technology' => 'Technology',
            'state' => 'State',
            'servicetime' => 'Servicetime',
            'servicerange' => 'Servicerange',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_del' => 'Is Del',
        ];
    }
}
