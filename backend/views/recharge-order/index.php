<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FRechargeOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '充值订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .frecharge-order-index table.table-hover .kv-grouped-row{background-color: #f4f4f4!important;}
    .frecharge-order-index table.table-hover .kv-grouped-row:hover{background-color: #e0e0e0!important;}
    #frechargeordersearch-create_time{background-color: #fff}
    /*修改日历样式*/
    .daterangepicker .ranges{float: none;margin: 0 auto;text-align: center}
    .sty_a{float: right;margin-top: -30px}
</style>
<div class="frecharge-order-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'export' => false , //不需要导出
        'hover'=>true,
        'panel'=>['type'=>'primary'],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'header' =>'序号',
            ],

            [
                'label' => '',
                'attribute' => 'create_time',
                'width' =>'12%',
                'format' => 'raw',
                //'format' => ["date", "php:Y-m"],
                'value' => function($data){
                    $month = date('Y-m',strtotime($data->create_time));
                    return $month . Html::a('<i class="fa fa-bar-chart-o"></i>&nbsp;查看月报表',['view?month='.$month],['class'=>'btn btn-primary sty_a']);
                },
                'filter' => false,
                'group'=>true,  // 分组
                'groupedRow'=>true,                    // move grouped column to a single grouped row
                'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
                'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
            ],

            [
                'attribute' =>'user_id',
                'width' =>'8%',
                'format' =>'raw',
                'value' => function($data){
                    return Html::a($data->user->username,['user/view?id='.$data->user_id]);
                },
                'group'=>true,  // enable grouping
                'subGroupOf'=>1 // 以第一列为父级参照分组
            ],
            'id',
            [
                'attribute' =>'platform',
                'width' => '5%',
                'value' => function($data){
                    return $data->platform ==1 ?'支付宝':'微信';
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['1'=>'支付宝','2'=>'微信'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>''],

                'group' => true,
                'subGroupOf'=>1, // 以第一列为父级参照分组

                'pageSummary'=>'总计',
                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            ],
            [
                'attribute' => 'money',
                'width' => '5%',
                'filter' => false,
                'format'=> ['decimal', 2],
                'pageSummary'=> true,
            ],
            [
                'attribute' => 'real_pay',
                'width' => '5%',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ],
             'trade_no',
            [
                'attribute' =>  'buyer',
                'width' => '8%',
                'filter' => false,
            ],

            [
                'attribute' =>'state',
                'format' => 'raw',
                'width' => '8%',
                'value' => function($data){
                    return $data->state ==0 ?
                        '<label class="text-justify">待付款</label>':
                        (
                        $data->state==9?'<label class="text-danger">付款成功</label>':
                            ($data->state==10 ?'<label class="text-success">订单更新成功</label>':'')
                        );
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>['9'=>'付款成功','10'=>'订单更新成功'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>''],
            ],
            [
                'attribute' => 'create_time',
                'width' =>'15%',
                'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'language' => 'zh-CN',
                    'value' => '',
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => [
                            'format' => 'Y-m-d',
                            'separator' => ' to ',
                        ],
                        'opens' => 'left'
                    ],
                ]
            ]

        ],
        'responsive'=>true,
        'condensed'=>true,
        'floatHeader'=>false,
        'toolbar' => [
            //按钮触发模态框  data-toggle 用于打开模态窗口；data-target：表示模态框的id
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'刷新'])
            ],
//            '{export}',
//            '{toggleData}',
        ],
    ]); ?>

</div>