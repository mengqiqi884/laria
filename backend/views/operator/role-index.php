<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=Url::toRoute('operator/role-index')?>" class="current">角色列表</a>
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
                        <?= Html::a('新增角色', ['role-create'], [
                            'class' => 'btn btn-success',
                        ]) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn'
                            ],
                            'name',
                            [
                                'attribute' => 'description',
                                'format' => 'ntext',
                                'class' => 'kartik\grid\EditableColumn',
                                'editableOptions'=>[
                                    'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
                                    'asPopover' => true,
                                ],
                            ],
                            'rule_name',
                            [
                                'attribute' =>  'created_at',
                                'format' => ['date','php:Y-m-d H:i:s'],
                            ],

                            [
                                'header' => '操作',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{role-delete}',
                                'buttons' => [
                                    'role-delete' => function($url,$model){
                                        return Html::a('<i class="icon-trash"></i> ', Url::to(['operator/role-delete','id'=>$model->i_id]), [
                                            'title' => '删除角色'
                                        ]);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


