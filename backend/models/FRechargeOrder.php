<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "f_recharge_order".
 *
 * @property string $id
 * @property string $user_id
 * @property string $money
 * @property string $create_time
 * @property string $modify_time
 * @property integer $platform
 * @property string $real_pay
 * @property string $trade_no
 * @property string $buyer
 * @property integer $state
 */
class FRechargeOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_recharge_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'money'], 'required'],
            [['money', 'real_pay'], 'number'],
            [['create_time', 'modify_time'], 'safe'],
            [['platform', 'state'], 'integer'],
            [['id', 'user_id', 'buyer'], 'string', 'max' => 50],
            [['trade_no'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '订单号',
            'user_id' => '用户昵称',
            'money' => '金额',
            'create_time' => '创建时间',
            'modify_time' => 'Modify Time',
            'platform' => '支付方式',
            'real_pay' => '实付金额',
            'trade_no' => '流水号',
            'buyer' => '买家',
            'state' => '状态',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
