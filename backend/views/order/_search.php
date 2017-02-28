<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_code') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'appliance_id') ?>

    <?= $form->field($model, 'uapp_id') ?>

    <?php // echo $form->field($model, 'brand_id') ?>

    <?php // echo $form->field($model, 'repair_id') ?>

    <?php // echo $form->field($model, 'merchant_id') ?>

    <?php // echo $form->field($model, 'master_id') ?>

    <?php // echo $form->field($model, 'offer_id') ?>

    <?php // echo $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'protect_id') ?>

    <?php // echo $form->field($model, 'lng') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'service_type') ?>

    <?php // echo $form->field($model, 'send_type') ?>

    <?php // echo $form->field($model, 'repair_time') ?>

    <?php // echo $form->field($model, 'order_verify_code') ?>

    <?php // echo $form->field($model, 'send_wl_code') ?>

    <?php // echo $form->field($model, 'send_wl_com') ?>

    <?php // echo $form->field($model, 'advance_price') ?>

    <?php // echo $form->field($model, 'check_price') ?>

    <?php // echo $form->field($model, 'repair_price') ?>

    <?php // echo $form->field($model, 'hardware_price') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'order_accuracy') ?>

    <?php // echo $form->field($model, 'voucher_money') ?>

    <?php // echo $form->field($model, 'nums') ?>

    <?php // echo $form->field($model, 'voucher_id') ?>

    <?php // echo $form->field($model, 'invoice') ?>

    <?php // echo $form->field($model, 'invoice_pic') ?>

    <?php // echo $form->field($model, 'buy_time') ?>

    <?php // echo $form->field($model, 'buy_mer_id') ?>

    <?php // echo $form->field($model, 'buy_address') ?>

    <?php // echo $form->field($model, 'is_confirm') ?>

    <?php // echo $form->field($model, 'is_comment') ?>

    <?php // echo $form->field($model, 'is_offer') ?>

    <?php // echo $form->field($model, 'is_paid') ?>

    <?php // echo $form->field($model, 'is_refund') ?>

    <?php // echo $form->field($model, 'is_complete') ?>

    <?php // echo $form->field($model, 'is_cash_pay') ?>

    <?php // echo $form->field($model, 'is_stop') ?>

    <?php // echo $form->field($model, 'stop_reason_id') ?>

    <?php // echo $form->field($model, 'stop_reason_detail') ?>

    <?php // echo $form->field($model, 'pay_type') ?>

    <?php // echo $form->field($model, 'pause_msg') ?>

    <?php // echo $form->field($model, 'return_state') ?>

    <?php // echo $form->field($model, 'return_money') ?>

    <?php // echo $form->field($model, 'return_wl_code') ?>

    <?php // echo $form->field($model, 'return_wl_com') ?>

    <?php // echo $form->field($model, 'order_type') ?>

    <?php // echo $form->field($model, 'order_step') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <?php // echo $form->field($model, 'pd_time') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'is_mer_del') ?>

    <?php // echo $form->field($model, 'is_user_del') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
