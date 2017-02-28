<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RepairOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'appliance_id')->textInput() ?>

    <?= $form->field($model, 'uapp_id')->textInput() ?>

    <?= $form->field($model, 'brand_id')->textInput() ?>

    <?= $form->field($model, 'repair_id')->textInput() ?>

    <?= $form->field($model, 'merchant_id')->textInput() ?>

    <?= $form->field($model, 'master_id')->textInput() ?>

    <?= $form->field($model, 'offer_id')->textInput() ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'protect_id')->textInput() ?>

    <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_type')->textInput() ?>

    <?= $form->field($model, 'send_type')->textInput() ?>

    <?= $form->field($model, 'repair_time')->textInput() ?>

    <?= $form->field($model, 'order_verify_code')->textInput() ?>

    <?= $form->field($model, 'send_wl_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'send_wl_com')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advance_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repair_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hardware_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_accuracy')->textInput() ?>

    <?= $form->field($model, 'voucher_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nums')->textInput() ?>

    <?= $form->field($model, 'voucher_id')->textInput() ?>

    <?= $form->field($model, 'invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buy_time')->textInput() ?>

    <?= $form->field($model, 'buy_mer_id')->textInput() ?>

    <?= $form->field($model, 'buy_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_confirm')->textInput() ?>

    <?= $form->field($model, 'is_comment')->textInput() ?>

    <?= $form->field($model, 'is_offer')->textInput() ?>

    <?= $form->field($model, 'is_paid')->textInput() ?>

    <?= $form->field($model, 'is_refund')->textInput() ?>

    <?= $form->field($model, 'is_complete')->textInput() ?>

    <?= $form->field($model, 'is_cash_pay')->textInput() ?>

    <?= $form->field($model, 'is_stop')->textInput() ?>

    <?= $form->field($model, 'stop_reason_id')->textInput() ?>

    <?= $form->field($model, 'stop_reason_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pay_type')->textInput() ?>

    <?= $form->field($model, 'pause_msg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_state')->textInput() ?>

    <?= $form->field($model, 'return_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_wl_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_wl_com')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_type')->textInput() ?>

    <?= $form->field($model, 'order_step')->textInput() ?>

    <?= $form->field($model, 'order_status')->textInput() ?>

    <?= $form->field($model, 'pd_time')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'is_mer_del')->textInput() ?>

    <?= $form->field($model, 'is_user_del')->textInput() ?>

    <?= $form->field($model, 'is_del')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
