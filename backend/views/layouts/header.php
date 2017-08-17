<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!--<header class="main-header">-->
<!---->
<!--    --><?//= Html::a('<span class="logo-mini">Laria</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
<!---->
<!--    <nav class="navbar navbar-static-top" role="navigation">-->
<!---->
<!--        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">-->
<!--            <span class="sr-only">Toggle navigation</span>-->
<!--        </a>-->
<!---->
<!--        <div class="navbar-custom-menu">-->
<!---->
<!--            <ul class="nav navbar-nav">-->
<!---->
<!--
<!--                <li class="dropdown messages-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-envelope-o"></i>-->
<!--                        <span class="label label-success">4</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">你有 1 条消息</li>-->
<!--                        <li>-->
<!--
<!--                            <ul class="menu">-->
<!--
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <div class="pull-left">-->
<!--                                            <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle"-->
<!--                                                 alt="User Image"/>-->
<!--                                        </div>-->
<!--                                        <h4>-->
<!--                                            Support Team-->
<!--                                            <small><i class="fa fa-clock-o"></i> 5 分钟之前</small>-->
<!--                                        </h4>-->
<!--                                        <p>Why not buy a new awesome theme?</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <!-- end message -->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer"><a href="#">查看更多..</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="dropdown notifications-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="fa fa-bell-o"></i>-->
<!--                        <span class="label label-warning">10</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">你有10个提醒</li>-->
<!--                        <li>-->
<!--
<!--                            <ul class="menu">-->
<!--
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <!--notifications end-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer"><a href="#">查看全部</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="dropdown user user-menu">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                        <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
<!--                        <span class="hidden-xs">--><?//=$user->username?><!--</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--
<!--                        <li class="user-header">-->
<!--                            <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
<!--                            <p>-->
<!--                                <small>当前时间：</small>--><?//=date('Y-m-d H:i:s')?>
<!---->
<!--                            </p>-->
<!--                        </li>-->
<!--                        <li class="user-footer">-->
<!--                            <div class="pull-left">-->
<!--                                <a href="#" class="btn btn-default btn-flat">个人资料</a>-->
<!--                            </div>-->
<!--                            <div class="pull-right">-->
<!--                                --><?//= Html::a(
//                                    '退出',
//                                    ['/site/logout'],
//                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
//                                ) ?>
<!--                            </div>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                -->
<!--                <li>-->
<!--                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </nav>-->
<!--</header>-->

    <!--Header-part-->
    <div id="header">
        <h1><a href="http://www.mafiashare.net">Shared on www.MafiaShare.net</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class=" dropdown" id="menu-messages">
                <a href="<?=Yii::$app->homeUrl?>" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle">
                    <i class="icon-user"><img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/></i>
                    <span class="text"><?=$user->a_name?></span>
<!--                    <span class="label label-important">5</span>-->
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="sAdd" title="" href="#">修改密码</a></li>
                    <li><a class="sInbox" title="" href="#">个人中心</a></li>
                </ul>
            </li>
            <li class="">
                <a title="" href="#">
                    <i class="icon icon-cog"></i>
                    <span class="text">设置</span>
                </a>
            </li>
            <li class="">
                <a title="" href="<?=\yii\helpers\Url::toRoute(['site/logout'])?>">
                    <i class="icon icon-share-alt"></i>
                    <span class="text">退出</span>
                </a>
            </li>
        </ul>
    </div>
<!--    <div id="search">-->
<!--        <input type="text" placeholder="Search here..."/>-->
<!--        <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>-->
<!--    </div>-->
    <!--close-top-Header-menu-->
