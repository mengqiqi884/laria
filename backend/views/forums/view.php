<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\CForums */

$this->title = rawurldecode($model->f_title);
$this->params['breadcrumbs'][] = ['label' => 'Cforums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cforums-view">

    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?= Url::toRoute(['site/index']) ?>" title="返回主页" class="tip-bottom"><i class="icon-home"></i>
                主页</a>
            <a href="#">社区管理</a>
            <a href="<?= Url::toRoute(['forums/index']) ?>" class="current">帖子列表</a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box widget-chat">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-comment"></i>
                        </span>
                        <h5><?= Html::encode($this->title) ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div class="chat-users panel-right2">
                            <div class="panel-content nopadding">
                                <img alt="" src="<?= $user->u_headImg ?>"/>
                                <a href="<?= Url::toRoute(['user/' . $model->f_user_id]) ?>" class="contact-list">
                                    <li>
                                        <span><?= $model->f_user_nickname ?></span>
                                    </li>
                                    <li>
                                        <span style="color: red">积分：<?=$user->u_score?></span>
                                    </li>
                                </a>

                            </div>
                        </div>
                        <div class="chat-content panel-left2">
                            <div class="chat-messages" id="chat-messages">
                                <?php
                                if(in_array($model->f_fup,[1,2])){ //1.用车报告 2.维修报告
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'f_car_cycle',
                                            'f_car_miles',
                                            [
                                                'attribute' =>'f_car_describle',
                                                'value' => rawurldecode($model->f_car_describle)
                                            ],
                                        ],
                                    ]);
                                }
                                ?>
                                <!--帖子正文内容 start-->
                                <div id="msg-1">
                                    <?php
                                        $contents =unserialize($model->f_content);
                                        if($contents){
                                            $html = '';
                                            foreach($contents as $content){
                                                $html .= rawurldecode($content->content);
                                            }
                                        }
                                        echo $html;
                                    ?>
                                </div>
                                <!--帖子正文内容 end-->
                                <!--帖子回复区 start-->
                                <div id="chat-messages-inner">
                                    <?php
                                    $html = '';
                                    if(count($replies)>1){

                                        foreach($replies as $reply){
                                            $html .= '<p id="msg-1" class="user-laukik" style="display: block;">';
                                            $html .= '<span class="msg-block">';
                                            $html .= '<img src="'.$reply->u_headImg.'" alt="">';
                                            $html .= '<strong>'.$reply->u_nickname.'</strong>';
                                            $html .= '<span class="time">- '.$reply->created_time.'</span>';
                                            $html .= '<span class="msg">'.$reply->content.'</span>';
                                            $html .= '</span>';
                                            $html .= '</p>';
                                        }
                                    }else{
                                        $html .= '<p id="msg-1" class="user-laukik" style="text-align: center"><span class="msg-block">暂无回复</span></p>';
                                    }

                                    echo $html;
                                    ?>
                                </div>
                                <!--帖子回复区 start-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
