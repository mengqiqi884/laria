<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "repair_order".
 *
 * @property integer $id
 * @property string $order_code
 * @property integer $user_id
 * @property integer $appliance_id
 * @property integer $uapp_id
 * @property integer $brand_id
 * @property integer $repair_id
 * @property integer $merchant_id
 * @property integer $master_id
 * @property integer $offer_id
 * @property integer $address_id
 * @property integer $protect_id
 * @property string $lng
 * @property string $lat
 * @property string $phone
 * @property string $username
 * @property string $address
 * @property string $remark
 * @property integer $service_type
 * @property integer $send_type
 * @property string $repair_time
 * @property integer $order_verify_code
 * @property string $send_wl_code
 * @property string $send_wl_com
 * @property string $advance_price
 * @property string $check_price
 * @property string $repair_price
 * @property string $hardware_price
 * @property string $total_price
 * @property double $order_accuracy
 * @property string $voucher_money
 * @property integer $nums
 * @property integer $voucher_id
 * @property string $invoice
 * @property string $invoice_pic
 * @property string $buy_time
 * @property integer $buy_mer_id
 * @property string $buy_address
 * @property integer $is_confirm
 * @property integer $is_comment
 * @property integer $is_offer
 * @property integer $is_paid
 * @property integer $is_refund
 * @property integer $is_complete
 * @property integer $is_cash_pay
 * @property integer $is_stop
 * @property integer $stop_reason_id
 * @property string $stop_reason_detail
 * @property integer $pay_type
 * @property string $pause_msg
 * @property integer $return_state
 * @property string $return_money
 * @property string $return_wl_code
 * @property string $return_wl_com
 * @property integer $order_type
 * @property integer $order_step
 * @property integer $order_status
 * @property string $pd_time
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_mer_del
 * @property integer $is_user_del
 * @property integer $is_del
 *
 * @property User $user
 */
class RepairOrder extends \yii\db\ActiveRecord
{
    public $mer_name; //mer_merchant
    public $name;  //appliance
    public $brand_name; //brand
    public $user_name;  //user
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_code', 'user_id', 'appliance_id', 'brand_id'], 'required'],
            [['user_id', 'appliance_id', 'uapp_id', 'brand_id', 'repair_id', 'merchant_id', 'master_id', 'offer_id', 'address_id', 'protect_id', 'service_type', 'send_type', 'order_verify_code', 'nums', 'voucher_id', 'buy_mer_id', 'is_confirm', 'is_comment', 'is_offer', 'is_paid', 'is_refund', 'is_complete', 'is_cash_pay', 'is_stop', 'stop_reason_id', 'pay_type', 'return_state', 'order_type', 'order_step', 'order_status', 'is_mer_del', 'is_user_del', 'is_del'], 'integer'],
            [['repair_time', 'buy_time', 'pd_time', 'created_at', 'updated_at'], 'safe'],
            [['advance_price', 'check_price', 'repair_price', 'hardware_price', 'total_price', 'order_accuracy', 'voucher_money', 'return_money'], 'number'],
            [['order_code', 'send_wl_code', 'send_wl_com', 'return_wl_code', 'return_wl_com'], 'string', 'max' => 450],
            [['lng', 'lat', 'phone'], 'string', 'max' => 300],
            [['username'], 'string', 'max' => 900],
            [['address', 'invoice_pic', 'buy_address'], 'string', 'max' => 1500],
            [['remark'], 'string', 'max' => 9000],
            [['invoice'], 'string', 'max' => 150],
            [['stop_reason_detail', 'pause_msg'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'order_code' => '订单号',
            'user_id' => '用户id',
            'user_name'=>'下单用户',
            'appliance_id' => '电器id',
            'name'=>'电器',
            'uapp_id' => '电器子类id',
            'brand_id' => '品牌id',
            'brand_name' => '品牌名',
            'repair_id' => '维修单id',
            'merchant_id' => '商户id',
            'mer_name' => '商户',
            'master_id' => '维修师傅',
            'offer_id' => '报价编号',
            'address_id' => '地址编号',
            'protect_id' => '商品编号',
            'lng' => '用户地址经度',
            'lat' => '用户地址纬度',
            'phone' => '联系方式',
            'username' => '收件人姓名',
            'address' => '收件地址',
            'remark' => '备注',
            'service_type' => '服务方式',
            'send_type' => '维修类别',
            'repair_time' => '预约服务时间',
            'order_verify_code' => '服务完成验证码',
            'send_wl_code' => 'Send Wl Code',
            'send_wl_com' => 'Send Wl Com',
            'advance_price' => 'Advance Price',
            'check_price' => '检查费',
            'repair_price' => '维修费',
            'hardware_price' => '配件费',
            'total_price' => '维修总价',
            'order_accuracy' => '报价准确度',
            'voucher_money' => '现金券抵用金额',
            'nums' => '数量',
            'voucher_id' => 'Voucher ID',
            'invoice' => '发票编号',
            'invoice_pic' => '发票图片',
            'buy_time' => '购买时间',
            'buy_mer_id' => '购买商家',
            'buy_address' => '购买地址',
            'is_confirm' => '是否确认报价',
            'is_comment' => '是否评价',
            'is_offer' => '是否报价',
            'is_paid' => '是否支付',
            'is_refund' => '是否退单',
            'is_complete' => '是否完成',
            'is_cash_pay' => '是否现金支付',
            'is_stop' => '是否终止',
            'stop_reason_id' => 'Stop Reason ID',
            'stop_reason_detail' => '终止理由明细',
            'pay_type' => '支付方式',
            'pause_msg' => 'Pause Msg',
            'return_state' => '退单状态',
            'return_money' => '退款金额',
            'return_wl_code' => 'Return Wl Code',
            'return_wl_com' => 'Return Wl Com',
            'order_type' => '订单类型',
            'order_step' => '订单完成状态',
            'order_status' => '订单支付状态',
            'pd_time' => '支付时间',
            'created_at' => '生成日期',
            'updated_at' => '更新日期',
            'is_mer_del' => '商户是否删除',
            'is_user_del' => '用户是否删除',
            'is_del' => '是否删除',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAppliance()
    {
        return $this->hasOne(Appliance::className(), ['appliance_id' => 'appliance_id']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    public function getMerchant()
    {
        return $this->hasOne(MerMerchant::className(), ['mer_id' => 'merchant_id']);
    }
}
