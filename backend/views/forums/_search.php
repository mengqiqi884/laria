<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ForumsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cforums-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'f_id') ?>

    <?= $form->field($model, 'f_fup') ?>

    <?= $form->field($model, 'f_user_id') ?>

    <?= $form->field($model, 'f_user_nickname') ?>

    <?= $form->field($model, 'f_pic') ?>

    <?php // echo $form->field($model, 'f_title') ?>

    <?php // echo $form->field($model, 'f_content') ?>

    <?php // echo $form->field($model, 'f_views') ?>

    <?php // echo $form->field($model, 'f_replies') ?>

    <?php // echo $form->field($model, 'f_is_top') ?>

    <?php // echo $form->field($model, 'f_is_first_top') ?>

    <?php // echo $form->field($model, 'f_state') ?>

    <?php // echo $form->field($model, 'f_car_cycle') ?>

    <?php // echo $form->field($model, 'f_car_miles') ?>

    <?php // echo $form->field($model, 'f_car_describle') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
