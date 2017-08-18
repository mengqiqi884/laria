<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use \yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户协议';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .redactor-editor {max-height: 580px;}
</style>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?= Yii::$app->getHomeUrl() ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">系统管理</a>
        <a href="<?= Url::toRoute('page/index') ?>" class="current"><?= Html::encode($this->title) ?></a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-leaf"></i></span>
                    <h5><?= Html::encode($this->title); ?></h5>
                </div>
                <div class="widget-content">
                    <div class="row-fluid" style="margin-top: 0;">
                        <?php $form = ActiveForm::begin()?>
                        <?php
                            echo $form->field($model, 'p_content')->widget(\yii\redactor\widgets\Redactor::className(),[
                                'clientOptions' => [
                                    'imageManagerJson' => ['/redactor/upload/image-json'],
                                    'imageUpload' => ['/redactor/upload/image'],  //上传图片目录
                                    'fileUpload' => ['/redactor/upload/file'],  //上传文件目录
                                    'lang' => 'zh_cn',  //语言
                                    'plugins' => ['fontcolor','imagemanager'], //插件
                                ]
                                ])->label(false);

                            echo Html::submitButton('保存',['class' => 'btn btn-success']);
                        ?>

                        <?php ActiveForm::end()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>