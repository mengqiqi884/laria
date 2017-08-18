<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FFilmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $mode=='on' ? '正在上映的电影' : ($mode=='off' ? '已下架的电影' : '即将上映的电影');
$this->params['breadcrumbs'][] = $this->title;

\backend\assets\AppAsset::register($this);
?>

<?php
    $datas = $dataProvider->getModels();
    foreach($datas as $data){
        $data->mode = $mode;  //给model里的“mode”字段赋“操作（正在上映、已下架、即将上映）”值
    }

?>
<style>
    .select2-container--krajee .select2-selection__clear{margin-right: -11px;}
    #ffilmssearch-release_time{background-color: #fff;}
</style>
<div class="ffilms-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'options'=>['id'=>'grid'],
        'export' => false , //不需要导出
        'striped'=>true,
        'pjax' => true,
        'panel' => ['type'=>'primary'],
        'pjaxSettings' => [
            'options' => [
                'id' => 'userinfo'
            ],
            'neverTimeout' => true,
        ],
        'columns' => [
            [
                'header' =>'序号',
                'class' => 'yii\grid\SerialColumn',
                'options' => [
                    'width' =>'3%',
                ]
            ],
            [
                'attribute' =>  'name',
                'width' => '12%',
                'hAlign' => 'center',
                'value' => function($data){
                    return $data->name;
                }
            ],

            [
                'attribute' =>  'pic',
                'width' => '18%',
                'hAlign' => 'center',
                'filter' => false, //不显示搜索框
                'format' => 'raw',
                'value' => function($data){
                    return Html::img('http://localhost/'.Yii::$app->params['base_file'].$data->pic,['height'=>'40','onclick'=>'showImg()']);
                }
            ],
            [
                'attribute' => 'director',
                'width' => '10%',
                'hAlign' => 'center',
                'filter' => false, //不显示搜索框
                'value' => function($data){
                    return $data->director;
                }
            ],

            [
                'attribute' => 'level',
                'width' => '5%',
                'hAlign' => 'center',
                'format' => 'raw',
                'value' =>function($data){
                  return '<label class="label label-success">'.$data->level.'</label>';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ['2D'=>'2D','3D'=>'3D'],
                'filterWidgetOptions' => [
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ],
            ],
            [
                'attribute' => 'score',
                'width' => '5%',
                'hAlign' => 'center',
                'format' => 'raw',
                'value' => function($data){
                    return ($data->score>9?'<i class="text-danger">':'<i class="text-justify">').$data->score.'</i>';
                }
            ],

            [
                'attribute' =>  'views',
                'width' => '8%',
                'hAlign' => 'center',
                'value' => function($data){
                    return $data->views.' 人';
                }
            ],
            [
                'attribute' => 'today_hot',
                'width' => '5%',
                'hAlign' => 'center',
                'format' => 'html',
                'value' => function($data){
                    return $data->today_hot==1?'<i class="fa fa-check-square-o text-success"></i>':'';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ['1'=>'是','0'=>'否'],
                'filterWidgetOptions' => [
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => ['allowClear' => true],
                ],
            ],

            [
                'attribute' => 'release_time',
                'width' => '12%',
                'hAlign' => 'center',
                'format' => ["date", "php:Y-m-d"],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'language' => 'zh-CN',
                    'options' => ['placeholder' => '', 'readonly' => true],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,

                    ]
                ]
            ],
            [
                'attribute' => 'state',
                'width' => '5%',
                'hAlign' => 'center',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    if($data->state==1){
                        return '<i class="btn btn-default btn-xs">上架中</i>';
                    }else{
                        return '<i class="btn btn-danger btn-xs">已下架</i>';
                    }
                },
//                'filterType' => GridView::FILTER_SELECT2,
//                'filter' => ['1'=>'上架中','0'=>'已下架'],
//                'filterWidgetOptions' => [
//                    'options' => ['placeholder' => ''],
//                    'pluginOptions' => ['allowClear' => true],
//                ],
            ],

            [
                'attribute' => 'created_time',
                'width' => '10%',
                'hAlign' => 'center',
                'filter' => false, //不显示搜索框
                'value' => function($data){
                    return $data->created_time;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '240'],
                'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{down}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>',$url.'&mode='.$model->mode, [
                            'title' => Yii::t('app', '查看'),
                            'class' => 'text-muted',
                            'style' => 'display:inline-block;width:2rem',
                        ]);
                    },

                    'update' => function($url,$model){
                        return Html::a('<i class="fa fa-edit"></i>',$url.'&mode='.$model->mode,[
                            'title' => Yii::t('app','编辑'),
                            'class' =>'text-info',
                            'style' => 'display:inline-block;width:2rem'
                        ]);
                    },

                    'down' => function ($url, $model) {
                        return Html::a('<i class="fa fa-ban"></i>', $url.'&mode='.$model->mode, [
                            'title' => Yii::t('app', '下架'),
                            'class' => 'text-danger',
                            'style' => 'display:inline-block;width:2rem'
                        ]);
                    },
                ]
            ],
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>false,
        'toolbar' => [
            //按钮触发模态框  data-toggle 用于打开模态窗口；data-target：表示模态框的id
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'], ['title'=>'添加', 'class'=>'btn btn-success']) . '   '.
//                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'添加', 'class'=>'btn btn-success', 'onclick'=>'#', 'data-toggle' => 'modal','data-target' => '#create-modal']) . '   '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [$mode=='on'?'film-on-index':($mode=='off'?'film-off-index':'film-soon-index')], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'刷新'])
            ],
//            '{export}',
//            '{toggleData}',
        ],
//        'export' => ['fontAwesome'=>true],
    ]); ?>

</div>

<script>

    function showImg(){
        layer.photos({
            photos: '#grid-container table' //直接从页面中获取图片，那么需要指向图片的父容器
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
        });
    }
</script>