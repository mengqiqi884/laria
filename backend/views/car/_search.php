<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'c_code') ?>

    <?= $form->field($model, 'c_title') ?>

    <?= $form->field($model, 'c_parent') ?>

    <?= $form->field($model, 'c_logo') ?>

    <?= $form->field($model, 'c_level') ?>

    <?php // echo $form->field($model, 'c_type') ?>

    <?php // echo $form->field($model, 'c_price') ?>

    <?php // echo $form->field($model, 'c_sortorder') ?>

    <?php // echo $form->field($model, 'c_imgoutside') ?>

    <?php // echo $form->field($model, 'c_imginside') ?>

    <?php // echo $form->field($model, 'c_volume') ?>

    <?php // echo $form->field($model, 'c_engine') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
