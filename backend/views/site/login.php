<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '登陆';

backend\assets\LoginAsset::register($this);
//$fieldOptions1 = [
//    'options' => ['class' => 'form-group has-feedback'],
//    'inputTemplate' => "{input}<span class='glyphicon glyphicon-phone form-control-feedback'></span>"
//];
//
//$fieldOptions2 = [
//    'options' => ['class' => 'form-group has-feedback'],
//    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
//];
?>
<!---->
<!--<div class="login-box">-->
<!--    <div class="login-logo">-->
<!--        <a href="#"><b>L a r i a</a>-->
<!--    </div>-->
<!---->
<!--    <div class="login-box-body">-->
<!---->
<!--        --><?php //$form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
<!---->
<!--        --><?//= $form
//            ->field($model, 'username', $fieldOptions1)
//            ->label(false)
//            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
<!---->
<!--        --><?//= $form
//            ->field($model, 'password', $fieldOptions2)
//            ->label(false)
//            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
<!---->
<!--        <div class="row">-->
<!--            <div class="col-xs-8">-->
<!--                --><?//= $form->field($model, 'rememberMe')->checkbox() ?>
<!--            </div>-->
<!---->
<!--            <div class="col-xs-4">-->
<!--                --><?//= Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        --><?php //ActiveForm::end(); ?>
<!---->
<!--        <div>-->
<!--            <a href="#">忘记密码？</a>&nbsp;&nbsp;-->
<!--            <a href="register.html" class="text-center" style="float: right">注册</a>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->


<div id="logo">
    <img src="<?=\yii\helpers\Url::to('@web/img/login-logo.png')?>" alt="" />
</div>
<div id="loginbox">
    <!--登陆 start-->
    <?php
//    $form = ActiveForm::begin(['id' => 'loginform','enableClientValidation' => false,'action'=>'#','novalidate'=>'novalidate'])
    ?>
    <form class="form-vertical" method="post"  action="<?=\yii\helpers\Url::toRoute(['site/login'])?>"  name="loginform" id="loginform" novalidate="novalidate">
        <div class="control-group normal_text"><h3>Laria Admin Login</h3></div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" placeholder="用户名" name="username" id="username"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-lock"></i></span>
                    <input type="password" placeholder="密码" name="pwd" id="pwd"/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-recover">忘记密码?</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-success" value="登录" /></span>
        </div>
    </form>
<!--    --><?php //ActiveForm::end(); ?>
    <!--登陆 end-->
    <!--忘记密码 start-->
    <form id="recoverform" action="#" class="form-vertical">
        <p class="normal_text">在下面填写您的邮箱地址，我们会告诉你 <br/><font color="#FF6633">怎样重新设置新密码.</font></p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="邮箱E-mail" />
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-login">&laquo; 返回</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-info" value="重置密码" /></span>
        </div>
    </form>
    <!--忘记密码  end-->
</div>

<script>
    function check_login(){

    }
</script>