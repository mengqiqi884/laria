<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=\yii\helpers\Url::toRoute('operator/role-index')?>" class="current">角色列表</a>
    </div>
</div>


<div class="container-fluid" style="width: 60%">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span>
                    <h5><?=Html::encode($title);?></h5>
                </div>
                <div class="widget-content">
                    <?php $form = ActiveForm::begin([
                        'type'=>ActiveForm::TYPE_HORIZONTAL,
                        //验证场景规则
                        //        'enableAjaxValidation' => true,
                        //        'validationUrl'=>\yii\helpers\Url::toRoute(['role-valid-form','id'=>empty($model['i_id'])?0:$model['i_id']]),
                    ]); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                    <!--    --><?//= $form->field($model, 'rule_name')->textInput(['maxlength' => true,'value' => 'SHANTE','disabled'=>true]) ?>

                    <div class="form-group" style="text-align: center">
                        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a('返回','javascript:history.back();',['class'=>'btn btn-default'])?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
