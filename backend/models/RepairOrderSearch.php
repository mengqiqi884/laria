<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RepairOrder;

/**
 * RepairOrderSearch represents the model behind the search form about `backend\models\RepairOrder`.
 */
class RepairOrderSearch extends RepairOrder
{
    public $name; //<=====就是加在这里
    public $brand_name; //<=====就是加在这里
    public $user_name; //<=====就是加在这里
    public $mer_name; //mer_merchant
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'appliance_id', 'uapp_id', 'brand_id', 'repair_id', 'merchant_id', 'master_id', 'offer_id', 'address_id', 'protect_id', 'service_type', 'send_type', 'order_verify_code', 'nums', 'voucher_id', 'buy_mer_id', 'is_confirm', 'is_comment', 'is_offer', 'is_paid', 'is_refund', 'is_complete', 'is_cash_pay', 'is_stop', 'stop_reason_id', 'pay_type', 'return_state', 'order_type', 'order_step', 'order_status', 'is_mer_del', 'is_user_del', 'is_del'], 'integer'],
            [['order_code', 'lng', 'lat', 'phone', 'username', 'address', 'remark', 'repair_time', 'send_wl_code', 'send_wl_com', 'invoice', 'invoice_pic', 'buy_time', 'buy_address', 'stop_reason_detail', 'pause_msg', 'return_wl_code', 'return_wl_com', 'pd_time', 'created_at', 'updated_at'], 'safe'],
            [['advance_price', 'check_price', 'repair_price', 'hardware_price', 'total_price', 'order_accuracy', 'voucher_money', 'return_money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RepairOrder::find();
        $query->joinWith(['user']); //<=====加入这句
        $query->joinWith(['appliance']); //<=====加入这句
        $query->joinWith(['brand']);  //<=====加入这句
        $query->joinWith(['mer_merchant']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'appliance_id' => $this->appliance_id,
            'uapp_id' => $this->uapp_id,
            'brand_id' => $this->brand_id,
            'repair_id' => $this->repair_id,
            'merchant_id' => $this->merchant_id,
            'master_id' => $this->master_id,
            'offer_id' => $this->offer_id,
            'address_id' => $this->address_id,
            'protect_id' => $this->protect_id,
            'service_type' => $this->service_type,
            'send_type' => $this->send_type,
            'repair_time' => $this->repair_time,
            'order_verify_code' => $this->order_verify_code,
            'advance_price' => $this->advance_price,
            'check_price' => $this->check_price,
            'repair_price' => $this->repair_price,
            'hardware_price' => $this->hardware_price,
            'total_price' => $this->total_price,
            'order_accuracy' => $this->order_accuracy,
            'voucher_money' => $this->voucher_money,
            'nums' => $this->nums,
            'voucher_id' => $this->voucher_id,
            'buy_time' => $this->buy_time,
            'buy_mer_id' => $this->buy_mer_id,
            'is_confirm' => $this->is_confirm,
            'is_comment' => $this->is_comment,
            'is_offer' => $this->is_offer,
            'is_paid' => $this->is_paid,
            'is_refund' => $this->is_refund,
            'is_complete' => $this->is_complete,
            'is_cash_pay' => $this->is_cash_pay,
            'is_stop' => $this->is_stop,
            'stop_reason_id' => $this->stop_reason_id,
            'pay_type' => $this->pay_type,
            'return_state' => $this->return_state,
            'return_money' => $this->return_money,
            'order_type' => $this->order_type,
            'order_step' => $this->order_step,
            'order_status' => $this->order_status,
            'pd_time' => $this->pd_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_mer_del' => $this->is_mer_del,
            'is_user_del' => $this->is_user_del,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'order_code', $this->order_code])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'send_wl_code', $this->send_wl_code])
            ->andFilterWhere(['like', 'send_wl_com', $this->send_wl_com])
            ->andFilterWhere(['like', 'invoice', $this->invoice])
            ->andFilterWhere(['like', 'invoice_pic', $this->invoice_pic])
            ->andFilterWhere(['like', 'buy_address', $this->buy_address])
            ->andFilterWhere(['like', 'stop_reason_detail', $this->stop_reason_detail])
            ->andFilterWhere(['like', 'pause_msg', $this->pause_msg])
            ->andFilterWhere(['like', 'return_wl_code', $this->return_wl_code])
            ->andFilterWhere(['like', 'return_wl_com', $this->return_wl_com]);

        $query->andFilterWhere(['like', 'user.username', $this->user_name]) ;//<=====加入这句
        $query->andFilterWhere(['like', 'appliance.name', $this->name]) ;//<=====加入这句
        $query->andFilterWhere(['like', 'brand.brand_name', $this->brand_name]) ;//<=====加入这句
        $query->andFilterWhere(['like', 'mer_merchant.mer_name', $this->mer_name]) ;//<=====加入这句

        return $dataProvider;
    }



}
