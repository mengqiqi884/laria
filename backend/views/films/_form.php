<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model backend\models\FFilms */
/* @var $form yii\widgets\ActiveForm */
\backend\assets\AppAsset::register($this);
\backend\assets\VideoAsset::register($this);
?>
<script src="<?=\yii\helpers\Url::to('@web/assets/c41a5643/js/fileinput.min.js')?>"></script>
<style>
    .field-ffilms-level .radio{float: left;width: 20%}
    .field-ffilms-pic .col-md-10{height: 275px;}
    .field-ffilms-pic .col-md-10 .file-input .kv-upload-progress .progress{margin-bottom: 5px}
    /*.field-ffilms-pic .file-input{height: 90%;}*/
    /*.field-ffilms-pic .file-preview{height: 80%}*/
    /*.field-ffilms-pic .file-preview .file-drop-zone{height:85%;}*/
    .field-ffilms-pic .file-preview .file-drop-zone .file-footer-caption {margin: 0;padding-top: 0;}
    .field-ffilms-pic .file-preview .file-drop-zone .file-actions{margin-top:10px;}
    .field-ffilms-pic .file-drop-zone-title{padding: 38px 10px!important;}
    .field-ffilms-pic .file-drop-zone .file-thumb-progress{top:15px;}
    .field-ffilms-pic .file-drop-zone .file-preview-frame{height: 120px;margin: 2px;}
    .field-ffilms-pic .file-drop-zone .file-preview-frame img{height: 70px!important;}
</style>
<div class="ffilms-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,

        'options' =>[
            'id' =>'film-form',
            'enctype' => 'multipart/form-data',
            'style' => 'width:50%'
        ]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bus_pic')->hiddenInput()->label(false);?>

    <?= $form->field($model, 'pic')->widget(\kartik\file\FileInput::className(),[
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'initialPreview' => empty($model->pic) ? false : [
                "<img src='http://localhost/" . Yii::$app->params['base_file'] . $model->pic . "'>'",
            ],
            'uploadUrl' => \yii\helpers\Url::to(['/upload/img?type=film']),
            'uploadAsync' => true,
            'initialPreviewAsData' => true,
            'overwriteInitial'=>true,  //允许覆盖
            'autoReplace' => true,
            'maxFileCount' => 1,
            // 展示图片区域是否可点击选择多文件
            'browseOnZoneClick' => true,

            'showUpload' => true,
            'showRemove' => false,

            'fileActionSettings' => [
                'showZoom' => true,
                'showUpload' => false,
                'showRemove' => false,
            ],
        ],
        'pluginEvents' => [
            'fileuploaderror' => "function(){
                        $('.fileinput-upload-button').attr('disabled',true);
                    }",
            'fileclear' => "function(){
                       $('#ffilms-bus_pic').val('');
                   }",
            'fileuploaded' => "function (object,data){
			           $('#ffilms-bus_pic').val(data.response.imageUrl);
		           }",
            //错误的冗余机制
            'error' => "function (){
			           alert('data.error');
		           }"
        ]
    ])->hint('图片尺寸200*200');?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leaders')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->radioList(['2D'=>'2D','3D'=>'3D'],['prompt'=>'2D']) ?>

    <?= $form->field($model, 'introduction')->textarea() ?>

    <?= $form->field($model, 'release_time')->widget(\kartik\widgets\DatePicker::className(),[
        'name' => 'check_date',
        'value' => date('Y-m-d'),
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?php if($model->isNewRecord){ ?>
        <?= $form->field($model, 'state')->dropDownList(['1'=>'上架','0'=>'下架']) ?>
    <?php } ?>


    <label class="control-label col-md-2" for="ffilms-video">视频花絮</label>
    <div class="col-md-10">
        <input id="ffilms-video" name="videos" type="file" multiple=true class="file-loading">
        <div class="help-block"></div>
    </div>

<!--    --><?//= $form->field($model, 'video')->widget(\kartik\file\FileInput::className(),[
//        'options' =>[
//            'multiple' =>true
//        ],
//        'pluginOptions' =>[
//            'initialPreviewAsData' =>true,
//            'uploadUrl' => \yii\helpers\Url::to(['/upload/video?filename='.document.getElementById('')]),
//            'uploadAsync' =>true,
//            'minFileCount' =>1,
//            'maxFileCount' =>1,
//            'overwriteInitial'=>true,  //允许覆盖
//            'browseOnZoneClick'=>true,
//            'autoReplace' => true,
//            'showUpload' => true,
//            'showRemove' => true,
//        ]
//    ]);?>

    <div class="form-group" style="margin: 0;text-align: center">
        <?= Html::submitButton($model->isNewRecord ? '保存' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
