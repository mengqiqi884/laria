<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\FRechargeOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frecharge-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'money') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'modify_time') ?>

    <?php // echo $form->field($model, 'platform') ?>

    <?php // echo $form->field($model, 'real_pay') ?>

    <?php // echo $form->field($model, 'trade_no') ?>

    <?php // echo $form->field($model, 'buyer') ?>

    <?php // echo $form->field($model, 'state') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
