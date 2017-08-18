<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/5
 * Time: 9:07
 */
$user=Yii::$app->user->identity;
?>

<div class="page" id="mine">
    <!--内容部分-->
    <div class="content infinite-scroll infinite-scroll-bottom ">
        <div class="content-block empty-top">
            <!--个人中心-->
            <div class="list-block empty-top">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">头像</div>
                                <div class="item-input">
                                    <?php
                                    if(empty($user)){
                                        echo '<span class="icon icon-me pull-right" onclick="open_login()"></span>';
                                    }else{
                                    ?>
                                        <?=empty($user->headImg)? '<span class="icon icon-default pull-right"></span>':'<span class="icon icon-default pull-right" style="background-image: url('.$user->headImg.')"></span>';?>
                                        <form id="upload_form" enctype="multipart/form-data">
                                            <input type="file" id="upload_img" class="upload-btn-inp" name="logo" accept="image/jpeg,image/jpg,image/png,image/gif" onchange="AjaxUploadImg('upload_form','logo','add',3);" />
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">昵称</div>
                                <div class="item-input">
                                    <span class="pull-right">
                                        <input type="text" value="<?=empty($user)?'':$user->nickname?>"  class="show-input" <?=empty($user)?' onfocus="open_login()"':''?>>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">账号</div>
                                <div class="item-input">
                                    <span class="show-input pull-right"><?=empty($user)?'':$user->account?></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">性别</div>
                                <div class="item-input">
                                    <?php
                                    if(empty($user)){
                                    ?>
                                        <a class="show-input pull-right sex" onclick="open_login()">女</a>
                                    <?php
                                    }else{
                                    ?>
                                        <a class="show-input create-actions pull-right sex" href='#' id="" ><?=$user->sex==1?'男':'女'?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">生日</div>
                                <div class="item-input">
                                    <?php
                                    if(empty($user)){
                                    ?>
                                        <input type="text" class="show-input pull-right" value="<?=date('Y-m-d')?>" onfocus="open_login()">
                                    <?php
                                    }else{
                                    ?>
                                        <!--data-toggle='date' 自动初始化日历组件-->
                                        <input type="text" data-toggle='date'  class="show-input pull-right" value="<?=empty($user->birthday)? date('Y-m-d'):$user->birthday?>"/>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">修改密码</div>
                                <div class="item-input">
                                    <?php
                                    if(empty($user)){
                                    ?>
                                        <a class="sex pull-right" href="#" onclick="open_login()"><span class="icon icon-right pull-right"></span></a>
                                    <?php
                                    }else{
                                    ?>
                                        <a class="sex pull-right prompt-title-ok " href="#"><span class="icon icon-right pull-right"></span></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>

</script>