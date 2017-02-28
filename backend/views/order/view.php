<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Repair Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_code',
            'user_id',
            'appliance_id',
            'uapp_id',
            'brand_id',
            'repair_id',
            'merchant_id',
            'master_id',
            'offer_id',
            'address_id',
            'protect_id',
            'lng',
            'lat',
            'phone',
            'username',
            'address',
            'remark',
            'service_type',
            'send_type',
            'repair_time',
            'order_verify_code',
            'send_wl_code',
            'send_wl_com',
            'advance_price',
            'check_price',
            'repair_price',
            'hardware_price',
            'total_price',
            'order_accuracy',
            'voucher_money',
            'nums',
            'voucher_id',
            'invoice',
            'invoice_pic',
            'buy_time',
            'buy_mer_id',
            'buy_address',
            'is_confirm',
            'is_comment',
            'is_offer',
            'is_paid',
            'is_refund',
            'is_complete',
            'is_cash_pay',
            'is_stop',
            'stop_reason_id',
            'stop_reason_detail',
            'pay_type',
            'pause_msg',
            'return_state',
            'return_money',
            'return_wl_code',
            'return_wl_com',
            'order_type',
            'order_step',
            'order_status',
            'pd_time',
            'created_at',
            'updated_at',
            'is_mer_del',
            'is_user_del',
            'is_del',
        ],
    ]) ?>

</div>
