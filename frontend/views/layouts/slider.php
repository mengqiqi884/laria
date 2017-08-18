<!-- popup, panel 等放在这里(点击左上角，出现侧栏) -->
<div class="panel-overlay"></div>
<!-- Left Panel with Reveal effect -->
<div class="panel panel-left panel-cover theme-dark">
    <div class="content-block-title">
        个人信息
    </div>
    <div class="list-block">
        <ul>
            <li class="item-content">
                <div class="item-media"><i class="icon icon-f7"></i></div>
                <div class="item-inner">
                    <div class="item-title">头像</div>
                    <?php
                        if(!empty($user)){
                            $style = $user->headImg ? 'background-image:url("'.$user->headImg.'")' : '';
                        }else{
                            $style = '';
                        }
                    ?>
                    <div class="item-after"><i class="icon icon-default" style="margin-top: 0; <?=$style?>"></i></div>
                </div>
            </li>
            <li class="item-content">
                <div class="item-media"><i class="icon icon-form-name"></i></div>
                <div class="item-inner">
                    <div class="item-title">昵称</div>
                    <div class="item-after"><?=empty($user) ? '小二儿': $user->nickname?></div>
                </div>
            </li>
            <li class="item-content">
                <div class="item-media"><i class="icon icon-form-name"></i></div>
                <div class="item-inner">
                    <div class="item-title">已连续签到</div>
                    <div class="item-after"><?=empty($user) ? 0: $user->continue_login_times?>天</div>
                </div>
            </li>
            <li class="content-padded">
                <!--class="external"自动拦截所有链接的touch行为，走浏览器原生跳转而不使用router-->
                <p><a href="<?=\yii\helpers\Url::toRoute(['site/logout'],true)?>" class="pull-right external">退出</a></p>
            </li>
        </ul>
    </div>
</div>
