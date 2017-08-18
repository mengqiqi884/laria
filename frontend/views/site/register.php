<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/4
 * Time: 10:22
 */
?>
<div class="popup popup-services">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left close-popup" data-transition='slide-out' >
            <span class="icon icon-left"></span>
        </a>
        <h1 class='title'>注册</h1>
    </header>

    <div class="content content-padded register">
        <div class="list-block">
            <ul>
                <!-- Text inputs -->
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">手机号</div>
                            <div class="item-input">
                                <input type="tel" placeholder="请输入手机号" name='account' onblur="validePhone(this.value)">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner" style="padding-right:0">
                            <div class="item-title label">验证码</div>
                            <div class="item-input">
                                <input type="tel" name='code' placeholder="请输入验证码" style="padding-left: 0" onblur="validecode(this.value)">
                                <button class="button button-warning btn-code" onclick="getCode(1)">获取验证码</button>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">密码</div>
                            <div class="item-input">
                                <input type="password" placeholder="请输入密码" name='pwd' onblur="validePassword(this.value)">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">确认密码</div>
                            <div class="item-input">
                                <input type="password" placeholder="再次输入密码" name='conpwd' onblur="confirmpassword(this.value)">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content-block">
            <div class="row">
                <a class="button button-big button-fill button-warning" onclick="getRegister()">提交</a>
            </div>
        </div>
    </div>
</div>
