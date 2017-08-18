<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FFilmsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ffilms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'pic') ?>

    <?= $form->field($model, 'publisher') ?>

    <?= $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'leaders') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'introduction') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'today-hot') ?>

    <?php // echo $form->field($model, 'release_time') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
