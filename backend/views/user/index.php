<?php

use yii\helpers\Html;

use \yii\bootstrap\Modal;
use yii\helpers\Url;
use \backend\models\Dist;
use kartik\editable\Editable;

\backend\assets\AppAsset::register($this);

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?//= Html::a('新增用户', "javascript:void(0);", ['id' => 'create', 'data-toggle' => 'modal','data-target' => '#create-modal','class' => 'btn btn-success']) ?>
        <?= Html::a('批量删除', "javascript:void(0);", ['class' => 'btn btn-danger gridview']) ?>
    </p>

    <?=\kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'options'=>['id'=>'grid'],
        'columns' => [
            [
                'class'=>\kartik\grid\CheckboxColumn::className(),
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value'=>$model->id,'class'=>'checkbox'];
                }
            ],
            'id',
            'username',
            'auth_key',
            'email',
            [
                'attribute'=>'role',
                'value'=>function($model){
                    return Dist::getTypeName($model->role,'后台用户');
                },
                'class'=>'kartik\grid\EditableColumn',
                'editableOptions'=>[
                    'format' => Editable::FORMAT_BUTTON,
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'asPopover' => true,
                    'data' =>Dist::getAllName('后台用户'),
                ],
            ],
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} &nbsp;&nbsp;{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"> 查看</i>', $url, [
                            'title' => Yii::t('app', '查看'),
                            'class' => 'del btn btn-primary btn-xs',
                        ]);
                    },

                    'delete' => function ($url, $model) {
                        if($model->status == 0){
                            return Html::a('<i class="fa fa-unlock-alt"> 激活</i>', $url, [
                                'title' => Yii::t('app', '激活'),
                                'class' => 'del btn btn-info btn-xs',
                                'data' => [
                                    'confirm' => '你确定要激活该用户吗?',
                                    'method' => 'post',
                                ],
                            ]);
                        }else{
                            return Html::a('<i class="fa fa-lock"> 禁用</i>', $url, [
                                'title' => Yii::t('app', '禁用'),
                                'class' => 'del btn btn-danger btn-xs',
                                'data' => [
                                    'confirm' => '你确定要禁用该用户吗?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    }

                ],

            ],

        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,
        'pjax'=>true,
        //set your toolbar
        'toolbar' => [
                //按钮触发模态框  data-toggle 用于打开模态窗口；data-target：表示模态框的id
            ['content' =>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'添加', 'class'=>'btn btn-success', 'onclick'=>'#', 'data-toggle' => 'modal','data-target' => '#create-modal']) . '   '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'刷新'])
            ],
            '{export}',
            '{toggleData}',
        ],
        'panel' => [
            'showFooter'=>true,
        ],
        'export' => ['fontAwesome'=>true],
    ]); ?>


    <?php
    //批量删除
    $this->registerJs('
        $(".content .gridview").on("click", function () {
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
