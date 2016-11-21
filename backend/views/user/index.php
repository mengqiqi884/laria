<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//\backend\assets\AppAsset::register($this);
//$this->registerJsFile('@web/js/export-table/export-user-table.js');
\dosamigos\tableexport\ButtonTableExportAsset::register($this);


$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?//= Html::encode($this->title) ?></h1>

    <p>
        <!-- 按钮触发模态框  data-toggle 用于打开模态窗口；data-target：表示模态框的id-->
        <?= Html::a('新增用户', "javascript:void(0);", ['id' => 'create', 'data-toggle' => 'modal','data-target' => '#create-modal','class' => 'btn btn-success']) ?>
        <?= Html::a('批量删除', "javascript:void(0);", ['class' => 'btn btn-danger gridview']) ?>
        <a id="linkId" >Export Table as Xml</a>
    </p>

    <?=\dosamigos\tableexport\ButtonTableExport::widget([

        'label' => 'Export Table',
        'selector' => '#grid > table', // any jQuery selector
        'split' => true,
        'exportClientOptions' => [
            'ignoredColumns' => [0, 7],
            'useDataUri' => false,
            'url' => \yii\helpers\Url::to('controller/download')
        ]])
    ?>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'grid-view','style'=>'overflow:auto', 'id' => 'grid'],
        'columns' => [
            [
                'class'=>\yii\grid\CheckboxColumn::className(),
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value'=>$model->id,'class'=>'checkbox'];
                }
            ],
            'id',
            'username',
            'auth_key',
            'email',
            [
                'attribute'=>'created_at',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model->created_at);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
            ],
        ],
    ]); ?>


    <?php
    $this->registerJs('
        $("#linkId").tableExport({
            type: "xml",
            useDataUri: true
        });
    ');


    //批量删除
    $this->registerJs('
        $(".gridview").on("click", function () {
            //注意这里的$("#grid")，要与gridview的options id保持一致
            var keys = $("#grid").yiiGridView("getSelectedRows");
            //console.log(keys);
            if(keys.length==0){
                layer.msg("请选择需要删除的用户");
            }else{
                $.post("ajax-delete-all",{uids:keys},function(data){
                    if(data.status=="200"){
                        window.location.reload();
                    }else{
                        layer.alert(data.message);
                    }
                },"json");
            }

        });
    ');
    //新增用户
    //模态框（Modal）
    Modal::begin([
        'id' => 'create-modal', //与上面的data-target值保持一致
        'header' => '<h4 class="modal-title">新建用户</h4>', //头部标题
//        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>', //底部
    ]);
    $requestUrl = Url::toRoute('create');
    $this->registerJs('
       $.get("'.$requestUrl.'", {},
            function (data) {
            $(".modal-body").html(data);
            });
    ');
    Modal::end();
    ?>
</div>
