<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\CAdmin */

$this->title = '管理员：'.$model->a_name;
$this->params['breadcrumbs'][] = ['label' => 'Cadmins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                                'attribute'=>'a_logo',
                                'format' => 'raw',
                                'value'=> '<img src="'.(empty($model->a_logo) ? Url::to('@web/img/icons/32/user.png'): Yii::$app->params['img_base'].$model->a_logo).'" class="user-img">'
                            ],
                            'a_realname',
                            'a_phone',
                            [
                                'attribute' => 'a_state',
                                'format' => 'html',
                                'value' => $model->a_state==1?
                                    '<span class="label label-success">启用</span>':'<span class="label label-info"> 禁用</span>',
                            ],
                            'last_login_time',
                            'created_time',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
