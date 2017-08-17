<?php

use yii\helpers\Html;

use \yii\bootstrap\Modal;
use yii\helpers\Url;
use \backend\models\Dist;
use kartik\editable\Editable;

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;


\backend\assets\TableAsset::register($this);

?>
<style>

    /*批量删除*/
    .del-all {
        margin: 0 12px 8px 0;border-radius:5px;box-shadow: 1px 2px 2px #ccc;
    }
    /*用户头像*/
    .user-img{
        border-radius: 3px;
        display: inline-block;
        height: 28px;
        margin-right: 10px;
        vertical-align: middle;
        width: 28px;
    }
</style>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=Url::toRoute('user/index')?>" class="current">用户列表</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span>
                    <h5><?=Html::encode($this->title);?></h5>
                </div>
                <div class="widget-content">
                    <a class="btn btn-danger del-all" onclick="delete_all()">批量删除</a>
                    <?=\kartik\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                            'options'=>['id'=>'grid'],
                            'export' => false , //不需要导出
                            'pjax' => true,
                            'pjaxSettings' => [
                                'options' => [
                                    'id' => 'userinfo'
                                ],
                                'neverTimeout' => true,
                            ],
                            'columns' => [
                                [
                                    'class'=>\yii\grid\CheckboxColumn::className(),
                                    'checkboxOptions' => function ($model, $key, $index, $column) {
                                        return ['value'=>$model->u_id,'class'=>'checkbox'];
                                    }
                                ],
                                [
                                    'attribute' =>'u_nickname',
                                    'width' => '15%',
                                    'format' => 'html',
                                    'value' => function($data){
                                        $headimg = empty($data->u_headImg) ? Url::to('@web/img/icons/32/user.png'):$data->u_headImg;
                                        return '<img src="'.$headimg.'" class="user-img">'.$data->u_nickname;
                                    }
                                ],
                                [
                                    'attribute' => 'u_phone',
                                    'headerOptions' => ['width' =>'150']
                                ],
                                [
                                    'attribute'=>'u_sex',
                                    'value'=>function($model){
                                        return $model->u_sex ==1?'男':($model->u_sex==2 ? '女':'性别未知');
                                    },
                                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                    'filter' => ['1'=>'男','2'=>'女'],
                                    'filterWidgetOptions' => [
                                        'options' => ['placeholder' => ''],
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                ],
                                [
                                    'attribute' => 'u_state',
                                    'format' => 'html',
                                    'headerOptions' => ['width' =>'210'],
                                    'class' => 'kartik\grid\EditableColumn',
                                    'editableOptions'=>[
                                        'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                        'asPopover' => false,
                                        'data' => ['1'=>'启用','2'=>'禁用'],
                                    ],
                                    'value' => function($model) {
                                        return $model->u_state == 1 ? '<span class="badge badge-success">启用</span>' : '<span class="badge badge-info">禁用</span>';
                                    },
                                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                    'filter' => ['1'=>'启用','2'=>'禁用'],
                                    'filterWidgetOptions' => [
                                        'options' => ['placeholder' => ''],
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                ],

                                [
                                    'attribute' => 'created_time',
                                    'filter' => false, //不显示搜索框
                                ],

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => '操作',
                                    'template' => '{view}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="icon-eye-open"></i>', $url, [
                                                'title' => Yii::t('app', '查看'),
                                            ]);
                                        }
                                    ],
                                ],
                            ],
                            'hover'=>true,
                            'responsive'=>true,
                            'condensed'=>true,
                            'floatHeader'=>false,
                        ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--    --><?php
//    //批量删除
//    $this->registerJs('
//        $(".content .gridview").on("click", function () {
//            //注意这里的$("#grid")，要与gridview的options id保持一致
//            var keys = $("#grid").yiiGridView("getSelectedRows");
//
//            if(keys.length==0){
//               layer.msg("请选择需要删除的用户");
//            }else{
//               $.post("ajax-delete-all",{uids:keys},function(data){
//                  layer.alert(data.message);
//                  if(data.status=="200"){
//                      window.location.reload();
//                  }
//               },"json");
//            }
//        });
//    ');
//    ?>


<script>
   function delete_all(){
            //注意这里的$("#grid")，要与gridview的options id保持一致
            var keys = $("#grid").yiiGridView("getSelectedRows");

            if(keys.length==0){
                layer.msg("请选择需要删除的用户");
            }else{
                $.post("ajax-delete-all",{uids:keys},function(data){
                    layer.alert(data.message);
                    if(data.status=="200"){
                        window.location.reload();
                    }
                },"json");
            }
   }



</script>