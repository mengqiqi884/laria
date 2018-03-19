<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CCar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'c_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_level')->textInput() ?>

    <?= $form->field($model, 'c_type')->textInput() ?>

    <?= $form->field($model, 'c_price')->textInput() ?>

    <?= $form->field($model, 'c_sortorder')->textInput() ?>

    <?= $form->field($model, 'c_imgoutside')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_imginside')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'c_engine')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
