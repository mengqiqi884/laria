<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '4s店列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=Url::toRoute('agent/index')?>" class="current">4s店列表</a>
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
                        <?= Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'], [
                            'title'=>Yii::t('app', '添加4s店'),
                            'class'=>'btn btn-success'
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app', '刷新')
                        ])?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'header' => '序号',
                                'class' => 'kartik\grid\SerialColumn'
                            ],
                            'a_name',
                            [
                                'attribute' => 'a_areacode',
                                'width' => '8%',
                                'value' => function($model){
                                    return \backend\models\CCity::getCityName($model->a_areacode);
                                },
                                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                'filter' => \backend\models\CAgent::getHaveCityList(),
                                'filterWidgetOptions' => [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                            ],
                            [
                                'attribute' => 'a_brand',
                                'width' => '8%',
                                'value' => function($model){
                                    return \backend\models\CCar::getBrandName($model->a_brand);
                                },
                                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                'filter' => \backend\models\CAgent::getHaveBrandList(),
                                'filterWidgetOptions' => [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                            ],

                            [
                                'attribute' => 'a_address',
                                'width'=> '15%',
                                'filter' => false
                            ],
                            [
                                'attribute' =>  'a_concat',
                                'width'=> '7%',
                                'filter' => false
                            ],
                            [
                                'attribute' =>  'a_phone',
                                'width'=> '5%',
                                'filter' => false
                            ],
                            [
                                'attribute' => 'a_email',
                                'format' => 'email',
                                'width'=> '7%',
                                'filter' => false
                            ],
                            [
                                'attribute' => 'a_position',
                                'width'=> '7%',
                                'filter' => false
                            ],
                            [
                                 'attribute' => 'a_state',
                                 'width' => '6%',
                                 'format' => 'html',
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
                            [
                                'attribute' => 'created_time',
                                'width' => '15%',
                                'value' => function($model){
                                    return $model->created_time;
                                },
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                                'filterType' => GridView::FILTER_DATE_RANGE,
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
                                ],
                            ],
                            [
                                'header' => '操作',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{update-pwd}{delete}',
                                'buttons' => [
                                    'update' => function($url,$model){
                                        return Html::a('<i class="icon-edit"></i> ',$url,[
                                            'title' => Yii::t('app', '编辑'),
                                        ]);
                                    },
                                    'update-pwd' => function($url,$model){
                                        return Html::a('<i class="icon-lock"></i> ','javascript:void(0);',[
                                            'id' => 'modify_pwd',
                                            'title'=>'修改密码',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#update-modal',
                                            'data-url' => $url,
                                        ]);
                                    },
                                    'delete' =>  function($url,$model){
                                        return Html::a('<i class="icon-trash"></i> ',$url,[
                                            'title' => Yii::t('app', '删除'),
                                        ]);
                                    }
                                ]
                            ],
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//modal弹框
\yii\bootstrap\Modal::begin(['id' => 'update-modal', //与上面的data-target值保持一致
    'header' => '<h4 class="modal-title"></h4>',
    'footer' =>  '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>',
]);
\yii\bootstrap\Modal::end();
?>

<script>
    /*
    *编辑登陆密码
    */
    $('a#modify_pwd').each(function () {
        $(this).on('click',function(){
            $.get($(this).attr("data-url"),{},function(data){
                $('#update-model .modal-body').empty();
                $('.modal-title').html('编辑登陆密码');
                $(".modal-body").html(data);
            })
        })
    })
</script>
