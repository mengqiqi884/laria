<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?= Yii::$app->getHomeUrl() ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">管理员列表</a>
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
                    <div class="row-fluid" style="margin-top: 0;width: 80%">
                        <?php $form = ActiveForm::begin([
                            'type'=>ActiveForm::TYPE_HORIZONTAL,
                            //验证场景规则
                            'enableAjaxValidation' => true,
                            'validationUrl'=>\yii\helpers\Url::toRoute(['valid-form','id'=>empty($model['a_id'])?0:$model['a_id']]),
                        ])?>

                        <?=$form->field($model, 'pic')->hiddenInput()->label(false);?>
                        <?= $form->field($model, 'a_logo')->widget(\kartik\file\FileInput::className(),[
                            'options'=>[
                                'accept'=>'image/*',
                            ],
                            'pluginOptions'=>[
                                'previewFileType' => 'image',
                                'initialPreview' =>[],
                                'initialPreviewConfig' =>[],
                                'uploadUrl' => \yii\helpers\Url::toRoute(['upload/img?type=logo']),
                                'uploadAsync' => true,
                                'showUpload'=>false,
                                'showRemove'=>false,
                                'autoReplace'=>true,
                                'dropZoneEnabled' => false,//是否显示拖拽区域，默认不写为true，但是会占用很大区域
                                // 展示图片区域是否可点击选择多文件
                                'browseOnZoneClick' => true,
                                'maxImageWidth' => '100',//限制图片的最大宽度
                                'maxImageHeight' => '100',//限制图片的最大高度
                                'maxFileCount'=>1,
                            ],
                            #图片上传成功后，调用fileuploaded，将图片路径传给隐藏input[id='admin_pic'],若上传多张图，则以 “[xxxx],[xxxxxxxx]”格式
                            'pluginEvents' => [
                                'filepredelete' => "function(event, key) {
                                    return (!confirm('确认要删除'));
                                }",
                                'fileuploaded' => 'function(event, data, previewId, index) {
                                    $("input#admin-pic").val(data.response.imageUrl);
                                     console.log(data.response.imageUrl);
                                }',
                                'filedeleted' => 'function(event, key) {
                                    var ov=$("input#admin-pic").val();
                                    $("input#admin-pic").val(ov.replace(""));
                                     console.log(key);
                                    return alert("图片已经删除")
                                }',
                            ]
                        ]) ?>

                        <?= $form->field($model, 'a_name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_pwd')->passwordInput(['value'=>'123456','readonly'=>'true']) ?>

                        <?= $form->field($model, 'a_realname')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_position')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_phone')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'a_type')->textInput(['value'=>'运营人员','readonly' => true]) ?>

                        <?= $form->field($model, 'a_role')->widget(\kartik\widgets\Select2::className(),[
                            'data'=>\backend\models\Admin::getAllRoleName(),
                            'options'=>['placeholder'=>'--请选择--'],
                            'pluginOptions'=>['allowClear'=>true],
                        ])?>

                        <?= $form->field($model,'province')->widget(\kartik\widgets\Select2::className(),[
                            'data' => \backend\controllers\ManagerController::getProvinceList(),
                            'options' => [
                                'id'=>'province_id'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('省')?>

                        <?= $form->field($model,'city')->widget(\kartik\widgets\DepDrop::className(),[
                            'options' => ['id' => 'city_id','placeholder' => '--请选择--'],
                            'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
                            'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                            'pluginOptions' => [
                                'depends' => ['province_id'],
                                'loadingText' => '城市加载中...',
                                'url' => \yii\helpers\Url::to(['manager/city'])
                            ]
                        ])->label('市')?>

<!--                        --><?//= $form->field($model,'area')->widget(\kartik\widgets\DepDrop::className(),[
//                            'pluginOptions' => [
//                                'depends' => ['province_id','city_id'],
//                                'placeholder' => 'select...',
//                                'url' => \yii\helpers\Url::to(['manager/area'])
//                            ]
//                        ])->label('区')?>


                        <div class="form-group" style="text-align: center">
                            <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
