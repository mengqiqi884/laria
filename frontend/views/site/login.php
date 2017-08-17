<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\Url;

\frontend\assets\LoginAsset::register($this);
?>
<div class="popup popup-about">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left close-popup" data-transition='slide-out'>
            <span class="icon icon-left"></span>
        </a>
        <h1 class='title'>登录</h1>
    </header>
    <div class="content content-padded">
<!--        <form action="" method="post" id="login-form" onsubmit="return checkInput();">-->
            <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-account"></i></div>
                                <div class="item-inner">
                                    <!--                            <div class="item-title label">账号</div>-->
                                    <div class="item-input">
                                        <input type="text" name="account" placeholder="请输入账号" onblur="validePhone(this.value)">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <!--                            <div class="item-title label">密码</div>-->
                                    <div class="item-input">
                                        <input type="password" name="pwd" placeholder="请输入密码（6~12位）" onblur="validePassword(this.value)">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Text inputs -->
                    </ul>
            </div>
            <div class="content-block">
                <div class="row">
                    <div class="col-50"><button type="submit" class="button button-big button-success" onclick="getLogin();">登录</button></div>
                    <div class="col-50"><a class="button button-big button-warning open-popup" data-popup=".popup-services">注册</a></div>
                </div>
            </div>
<!--        </form>-->
    </div>
</div>

<!--注册-->
<?= $this->render(
'register.php'
);?>