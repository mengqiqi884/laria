<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/11/7
 * Time: 14:34
 */
use \yii\helpers\Html;
use \kartik\grid\GridView;
use yii\helpers\Url;

$this->title = '运营人员列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=Url::toRoute('operator/role-index')?>" class="current">运营人员列表</a>
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
                    <h5><?= Html::encode($this->title);?></h5>
                </div>
                <div class="widget-content">
                    <p>
                        <?= Html::a('新增运营人员', ['operator-create'], [
                            'class' => 'btn btn-success',
                        ]) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn'
                            ],
                            'a_name',
                            'a_realname',
                            'a_phone',
                            [
                                'attribute'  => 'a_role',
                                'headerOptions' => ['width' =>'280'],
                                'value' => function($model){
                                    return \backend\models\Admin::getAdminRoleName($model->a_role);
                                },

                            ],

                            [
                                'attribute' =>  'a_state',
                                'format' => 'html',
                                'class' => 'kartik\grid\EditableColumn',
                                'editableOptions'=>[
                                    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                    'asPopover' => true,
                                    'data' => ['1'=>'启用','2'=>'禁用'],
                                ],
                                'value' => function($model) {
                                    return $model->a_state == 1 ? '<span class="badge badge-success">启用</span>' : '<span class="badge badge-info">禁用</span>';
                                },
                            ],

                            [
                                'attribute' =>   'created_time',
                                'format' => ['date','php:Y-m-d H:i:s'],
                            ],

                            [
                                'header' => '操作',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{operator-delete}',
                                'buttons' => [
                                    'operator-delete' => function($url,$model){
                                        return Html::a('<i class="icon-trash"></i> ', $url, [
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
