<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CAgent */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?= Yii::$app->getHomeUrl() ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=\yii\helpers\Url::to(['agent/index'])?>" class="current">4s店列表</a>
    </div>
</div>

<div class="container-fluid" style="width: 60%">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
<!--                    <span class="icon"><i class="icon-leaf"></i></span>-->
                    <h5><?= Html::encode($this->title); ?></h5>
                </div>
                <div class="widget-content">
                    <div class="row-fluid" style="margin-top: 0;">
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'a_account')->textInput(['maxlength' => true,$model->isNewRecord ? '' : 'disabled'=>true]) ?>


                        <?= $model->isNewRecord ? $form->field($model, 'a_pwd')->passwordInput(['maxlength' => true]) : ''?>

                        <?= $form->field($model, 'a_name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_areacode')->widget(\kartik\widgets\Select2::className(),[
                            'data'=>\backend\models\CCity::getAllCityList(),
                            'options'=>['placeholder'=>'--请选择--'],
                            'pluginOptions'=>['allowClear'=>true],
                        ]) ?>

                        <?= $form->field($model, 'a_brand')->widget(\kartik\widgets\Select2::className(),[
                            'data'=>\backend\models\CCar::getAllBrandList(),
                            'options'=>['placeholder'=>'--请选择--'],
                            'pluginOptions'=>['allowClear'=>true],
                        ]) ?>

                        <?= $form->field($model, 'a_address')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_concat')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_phone')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_position')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_state')->dropDownList(['1'=>'启用','2'=>'禁用']) ?>

                        <div class="form-group" style="text-align: center;">
                            <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a('返回','javascript:history.back();',['class'=> 'btn btn-default'])?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

