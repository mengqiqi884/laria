<?php

use yii\helpers\Html;
use \kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ForumsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帖子列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .kv-editable-content .kv-editable-form-inline .form-group:last-child{margin-left:5px;}
</style>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?= Yii::$app->getHomeUrl() ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">社区管理</a>
        <a href="<?= Url::toRoute('forums/index') ?>" class="current"><?= Html::encode($this->title) ?></a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-comment"></i></span>
                    <h5><?= Html::encode($this->title); ?></h5>
                </div>
                <div class="widget-content">
                    <div class="row-fluid" style="margin-top: 0;">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'export' =>false,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'f_fup',
                                    'headerOptions' => ['width' => '160'],
                                    'value' => function($data){
                                        $fup = \backend\models\CForums::getForumTopicName($data->f_fup);
                                        return $fup['ff_name'];
                                    },
                                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                    'filter' => \backend\models\CForumForum::get_type(),
                                    'filterWidgetOptions' => [
                                        'options' => ['placeholder' => ''],
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                ],
                                [
                                    'attribute' =>  'f_pic',
                                    'headerOptions' => ['width' => '100'],
                                    'format' => 'raw',
                                    'value' => function($data) {
                                        return Html::img($data->f_pic,['width'=>'80px','height'=>'auto']);
                                    },
                                    'filter' => false,
                                ],
                                [
                                    'attribute' => 'f_user_nickname',
                                    'headerOptions' => ['width' => '100'],
                                    'format' => 'html',
                                    'value' => function($data) {
                                        return Html::a($data->f_user_nickname,Url::toRoute(['user/'.$data->f_user_id]),['class'=>'']);
                                    }
                                ],
                                [
                                    'attribute' =>  'f_title',
                                    'value' => function($data){
                                        return rawurldecode($data->f_title);
                                    },
                                    'filter' => false,
                                ],
                                [
                                    'attribute' =>  'f_views &nbsp;/&nbsp; f_replies',
                                    'header' => '浏览量 / 回复数',
                                    'headerOptions' => ['width' => '100'],
                                    'format' => 'html',
                                    'value' => function($data){
                                        return '<span class="label label-success">' . $data->f_views . '</span>'. '&nbsp;/&nbsp;' . '<span class="label label-info">' .$data->f_replies . '</span>';
                                    },
                                    'filter' => false,
                                ],
                                [
                                    'attribute' =>  'f_is_top',
                                    'headerOptions' => ['width' => '80'],
                                    'format' => 'html',
                                    'value' => function($data) {
                                        return $data->f_is_top ? '<i class="icon-ok-circle"></i>' : '';
                                    },
                                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                    'filter' =>['1'=>'置顶','0'=>'非置顶'],
                                    'filterWidgetOptions' => [
                                        'options' => ['placeholder' => ''],
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                ],
                                [
                                    'attribute' => 'f_state',
                                    'headerOptions' => ['width' => '120'],
                                    'format' => 'html',
                                    'class' => 'kartik\grid\EditableColumn',
                                    'editableOptions'=>[
                                        'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                        'asPopover' => false,
                                        'data' => ['1'=>'正常','-1'=>'禁用'],
                                    ],
                                    'value' => function($data) {
                                        return $data->f_state==1 ? '<span class="icon-ok-circle"></span>正常' : '<span class=" icon-ban-circle"></span>禁用';
                                    },
                                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                                    'filter' => ['1'=>'正常','2'=>'禁用'],
                                    'filterWidgetOptions' => [
                                        'options' => ['placeholder' => ''],
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                ],
                                [
                                    'attribute' => 'created_time',
                                    'headerOptions' => ['width' => '150'],
                                    'format' => ['date', 'php:Y-m-d'],
                                    'filter' => false,
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => '操作',
                                    'template' => '{view} &nbsp;&nbsp;{delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<i class="icon-eye-open"></i>', $url, [
                                                'title' => Yii::t('app', '查看'),
                                            ]);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class=" icon-trash"></i>', $url, [
                                                'title' => Yii::t('app', '删除'),
                                            ]);
                                        }
                                    ]
                                ],
                            ],
                            'panel' => [
                                'after'=>Html::a('<i class="icon-refresh"></i>', ['index'], ['class' => '']),
                                'showFooter'=>false
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>