<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AgentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cagent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'a_id') ?>

    <?= $form->field($model, 'a_account') ?>

    <?= $form->field($model, 'a_pwd') ?>

    <?= $form->field($model, 'a_name') ?>

    <?= $form->field($model, 'a_areacode') ?>

    <?php // echo $form->field($model, 'a_brand') ?>

    <?php // echo $form->field($model, 'a_address') ?>

    <?php // echo $form->field($model, 'a_concat') ?>

    <?php // echo $form->field($model, 'a_phone') ?>

    <?php // echo $form->field($model, 'a_email') ?>

    <?php // echo $form->field($model, 'a_position') ?>

    <?php // echo $form->field($model, 'a_state') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
