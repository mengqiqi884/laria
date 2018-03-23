<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "c_orders".
 *
 * @property string $o_id
 * @property string $o_code
 * @property string $o_user_id
 * @property string $o_usercar_id
 * @property string $o_usercar
 * @property string $o_replace_id
 * @property string $o_replacecar
 * @property string $o_agency_id
 * @property string $o_fee
 * @property integer $o_state
 * @property string $created_time
 * @property integer $is_del
 *
 * @property COrderremarks[] $cOrderremarks
 * @property CUser $oUser
 * @property CCarreplace $oUsercar
 * @property CCarreplace $oReplace
 * @property CAgent $oAgency
 */
class COrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['o_code', 'o_user_id', 'o_usercar_id', 'o_replace_id', 'o_agency_id'], 'required'],
            [['o_user_id', 'o_usercar_id', 'o_replace_id', 'o_agency_id', 'o_state', 'is_del'], 'integer'],
            [['o_fee'], 'number'],
            [['created_time'], 'safe'],
            [['o_code'], 'string', 'max' => 20],
            [['o_usercar', 'o_replacecar'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'o_id' => 'O ID',
            'o_code' => 'O Code',
            'o_user_id' => 'O User ID',
            'o_usercar_id' => 'O Usercar ID',
            'o_usercar' => 'O Usercar',
            'o_replace_id' => 'O Replace ID',
            'o_replacecar' => 'O Replacecar',
            'o_agency_id' => 'O Agency ID',
            'o_fee' => 'O Fee',
            'o_state' => 'O State',
            'created_time' => 'Created Time',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOrderremarks()
    {
        return $this->hasMany(COrderremarks::className(), ['or_order_id' => 'o_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOUser()
    {
        return $this->hasOne(CUser::className(), ['u_id' => 'o_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOUsercar()
    {
        return $this->hasOne(CCarreplace::className(), ['r_id' => 'o_usercar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOReplace()
    {
        return $this->hasOne(CCarreplace::className(), ['r_id' => 'o_replace_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOAgency()
    {
        return $this->hasOne(CAgent::className(), ['a_id' => 'o_agency_id']);
    }
}
