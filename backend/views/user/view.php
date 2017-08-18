<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
$this->title = '用户：'.$model->u_nickname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /*用户头像*/
    .user-img{
        border-radius: 50px;
        display: inline-block;
        height: 50px;
        margin-right: 10px;
        vertical-align: middle;
        width: 50px;
    }
</style>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">账号管理</a>
        <a href="<?=Url::toRoute('user/index')?>" class="current">用户列表</a>
        <a href="#" class="current"><?=$this->title?></a>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class=" icon-bookmark"></i></span>
                    <h5><?=$this->title?></h5>
                </div>
                <div class="widget-content">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute'=>'u_headImg',
                                'format' => 'raw',
                                'value'=> '<img src="'.(empty($model->u_headImg) ? Url::to('@web/img/icons/32/user.png'):$model->u_headImg).'" class="user-img">'
                            ],
                            'u_nickname',
                            'u_phone',
                            [
                                'attribute' => 'u_state',
                                'format' => 'html',
                                'value' => $model->u_state==1?'<span class="label label-success">启用</span>':'<span class="label label-info"> 禁用</span>',
                            ],
                            'created_time',
                        ],
                    ]) ?>
                    <!--您好-->
                    <a href="<?=\yii\helpers\Url::toRoute('user/index')?>" class="btn btn-info"><i class=" icon-chevron-left"></i>返回</a>
                </div>
            </div>
        </div>
    </div>
</div>
