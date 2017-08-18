<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use \yii\helpers\Url;

backend\assets\FormAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\CBanner */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Url::toRoute(['site/index'])?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="tip-bottom">系统管理</a>
        <a href="<?=Url::toRoute(['banner/index'])?>" class="current">广告图展示</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                    </span>
                    <h5>编辑广告图</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="control-group" style="line-height: 25px;padding:5px 5px;margin-left: 30px">
                        <i class="icon-tint"></i>注意： &nbsp;&nbsp;表单中的‘<i class="icon-asterisk"></i>’是必填的
                    </div>
                    <form action="<?=$model->isNewRecord ? Url::toRoute(['banner/create']):Url::toRoute(['banner/update?id='.$model->b_id ]) ?>"
                          method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return checkInput()">

                        <input type="hidden" name="actions" value="<?=$model->isNewRecord ? 'yes' : 'no'?>">
                        <div class="control-group field-cbanner-b_location">
                            <label class="control-label" style="margin-left:0px"><i class="icon-asterisk"></i>广告图位置</label>
                            <div class="controls">
                                <select id="cbanner-b_location" name="CBanner[b_location]" <?=$model->isNewRecord ? '':'disabled'?>>
                                    <option value="1" <?=$model->b_location==1 ? 'selected="selected"':''?>>首页</option>
                                    <option value="2" <?=$model->b_location==2 ? 'selected="selected"':''?>>用车报告</option>
                                    <option value="3" <?=$model->b_location==3 ? 'selected="selected"':''?>>维修保养</option>
                                </select>
                            </div>
                        </div>

                        <div class="control-group field-cbanner-b_img">
                            <label class="control-label"><i class="icon-asterisk"></i>上传图片</label>
                            <div class="controls">
                                <?php if(!$model->isNewRecord){?>
                                <img src="../../../<?=$model->b_img?>" width="200" height="auto">
                                <?php }?>
                                <input id="cbanner-b_img"  name="b_img" type="file" />
                            </div>
                        </div>

                        <div class="control-group field-cbanner-b_url">
                            <label class="control-label">广告图跳转链接</label>
                            <div class="controls">
                                <input id="cbanner-b_url" type="text"  class="span6" name="CBanner[b_url]" value="<?=$model->b_url?>"  />
                            </div>
                        </div>

                        <div class="control-group field-cbanner-b_title">
                            <label class="control-label">广告图标题</label>
                            <div class="controls">
                                <input id="cbanner-b_title" type="text" class="span6" name="CBanner[b_title]" value="<?=$model->b_title?>"/>
                            </div>
                        </div>

                        <div class="control-group field-cbanner-content">
                            <label class="control-label">广告图简介</label>
                            <div class="controls">
                                <textarea id="cbanner-content" name="CBanner[content]" class="span6" ><?=$model->content?></textarea>
                            </div>
                        </div>

                        <div class="control-group field-cbanner-b_sortorder">
                            <label class="control-label"><i class="icon-asterisk"></i>排序</label>
                            <div class="controls">
                                <input id="cbanner-b_sortorder"  name="CBanner[b_sortorder]"  type="text" value="<?=$model->isNewRecord ? 1:$model->b_sortorder?>" />
                            </div>
                        </div>

                        <div class="form-actions">
                            <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a('返回',Url::toRoute(['banner/index']),['class'=>'btn btn-default']) ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>