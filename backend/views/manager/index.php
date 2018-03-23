<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;

\backend\assets\TableAsset::register($this);

?>

<style>
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
        <a href="#" class="current">管理员列表</a>
    </div>
</div>

<?php
//弹出操作成功提示
if( Yii::$app->getSession()->hasFlash('success') ) {
    echo \yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-success alert-dismissable', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);
}
//弹出操作失败提示
if( Yii::$app->getSession()->hasFlash('error') ) {
    echo \yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-danger alert-dismissable',
        ],
        'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span>
                    <h5><?=Html::encode($this->title);?></h5>
                </div>
                <div class="widget-content">
                    <p>
                        <?= Html::a('新增管理员', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?= \kartik\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'export' => false , //不需要导出

                        'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                                'attribute' =>'a_name',
                                'width' => '15%',
                                'format' => 'html',
                                'value' => function($data){
                                    $headimg = empty($data->a_logo) ? \yii\helpers\Url::to('@web/img/icons/32/user.png'):Yii::$app->params['img_base'] . $data->a_logo;
                                    return '<img src="'.$headimg.'" class="user-img">'.$data->a_name;
                                }
                            ],
                            'a_realname',
                             'a_position',
                             'a_phone',
                             'a_email:email',
                            [
                                'attribute'  => 'a_role',
                                'headerOptions' => ['width' =>'280'],
                                'class' => 'kartik\grid\EditableColumn',
                                'editableOptions'=>[
                                    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                    'asPopover' => false,
                                    'data' => \backend\models\Admin::getAllRoleName(),
                                ],
                                'value' => function($model){
                                    return \backend\models\Admin::getAdminRoleName($model->a_role);
                                },
                                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                'filter' => \backend\models\Admin::getAllRoleName(),
                                'filterWidgetOptions' => [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                            ],
                            [
                                'attribute' => 'a_state',
                                'format' => 'html',
                                'headerOptions' => ['width' =>'210'],
                                'class' => 'kartik\grid\EditableColumn',
                                'editableOptions'=>[
                                    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                    'asPopover' => false,
                                    'data' => ['1'=>'启用','2'=>'禁用'],
                                ],
                                'value' => function($model) {
                                    return $model->a_state == 1 ? '<span class="badge badge-success">启用</span>' : '<span class="badge badge-info">禁用</span>';
                                },
                                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                'filter' => ['1'=>'启用','2'=>'禁用'],
                                'filterWidgetOptions' => [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                            ],

                             'last_login_time',
                             'created_time',
                            [
                                'header' => '操作',
                                'class' => 'kartik\grid\ActionColumn',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<i class="icon-eye-open"></i>', 'javascript:void(0);', [
                                            'id' => 'view',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#view-modal',
                                            'data-url' =>  \yii\helpers\Url::toRoute(['view?id=' . $model->a_id]),
                                        ]);
                                    }
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//modal弹框
\yii\bootstrap\Modal::begin(['id' => 'view-modal', //与上面的data-target值保持一致
    'header' => '<h4 class="modal-title"></h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);
\yii\bootstrap\Modal::end();
?>

<script>
    /*
     *查看
     */
    $("a#view").each(function () {
        $(this).on('click',function () {
            $.get($(this).attr("data-url"), {},
                function (data) {
                    $('#view-modal').find('.modal-body').empty();
                    $('.modal-title').html('查看详情');
                    $(".modal-body").html(data);
                }
            );
        })
    });

</script>
