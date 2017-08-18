<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/5
 * Time: 9:51
 */
$user = Yii::$app->user->identity;
if(!empty($user)){
    $headImg = 'background-image:url("'.$user->headImg.'")';
    $name = $user->nickname ;
}else{
    $headImg =''; $name ='小二儿';
}
?>
<div class="page" id="setting">
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell">
                    <a class="setting-common-a" href="#mine">
                        <i class="icon icon-default pull-left head-img" id="head-img" style="<?=$headImg?>"></i>
                        <div class="mui-media-body" style="position: absolute;left:15%;width: 85%;top: 10px;">
                            <?=$name?>
                            <span class="icon icon-right"></span>
                        </div>
                    </a>
                </li>
            </ul>
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell">
                    <a href="#account" class="setting-common-a">账号与安全
                        <span class="icon icon-right "></span>
                    </a>
                </li>
            </ul>
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell">
                    <a href="#notifications" class="">新消息通知
                        <span class="icon icon-right "></span>
                    </a>
                </li>
                <li class="mui-table-view-cell">
                    <a href="#privacy" class="">隐私
                        <span class="icon icon-right "></span>
                    </a>
                </li>
                <li class="mui-table-view-cell">
                    <a href="#general" class="">通用
                        <span class="icon icon-right "></span>
                    </a>
                </li>
            </ul>
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell">
                    <a href="#about" class="">关于SUI
                        <span class="icon icon-right "></span>
                        <i class="pull-right update">V3.6.0</i>
                    </a>
                </li>
            </ul>
            <ul class="mui-table-view mui-table-view-chevron">
                <li class="mui-table-view-cell" style="text-align: center;">
                    <a>退出登录</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?=$this->render('mine.php')?>
<?=$this->render('verifyform.php')?>
