<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CRole */
/* @var $form yii\widgets\ActiveForm */
?>


<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=\yii\helpers\Url::toRoute('operator/operator-index')?>" class="current">运营人员列表</a>
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
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'a_name')->textInput() ?>

                    <?= $form->field($model, 'a_pwd')->passwordInput() ?>

                    <?= $form->field($model, 'a_realname')->textInput() ?>

                    <?= $form->field($model, 'a_phone')->textInput() ?>

                    <?= $form->field($model, 'a_role')->dropDownList(\backend\models\Admin::getAllRoleName()) ?>

                    <div class="form-group" style="text-align: center">
                        <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end();?>
                </div>
            </div>
        </div>
    </div>
</div>
