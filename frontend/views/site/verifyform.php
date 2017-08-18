<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/16
 * Time: 10:45
 */
?>
<script src="http://g.alicdn.com/sj/lib/jquery.min.js"></script>
<script src="<?=\yii\helpers\Url::to('@web/SUI/js/validate.js')?>"></script>
<script src="<?=\yii\helpers\Url::to('@web/SUI/js/validate-rules.js')?>"></script>

<div id="account" class="page">
    <form class="sui-form form-horizontal sui-validate" id="form-msg" method="post">
        <div class="control-group">
            <label for="inputEmail" class="control-label">邮箱：</label>
            <div class="controls">
                <input id="inputEmail" name="name" placeholder="邮箱" data-rules="required|email" type="text">
            </div>
        </div>
        <div class="control-group">
            <label for="inputPassword" class="control-label">密码：</label>
            <div class="controls">
                <input id="inputPassword" name="password" placeholder="密码" data-rules="required" title="密码" type="password">
            </div>
        </div>
        <div class="control-group">
            <label for="inputRepassword" class="control-label">重复密码：</label>
            <div class="controls">
                <input id="inputRepassword" name="repassword" placeholder="重复密码" data-rules="required|match=password" type="password">
            </div>
        </div>
        <div class="control-group">
            <label for="inputGender" class="control-label">性别：</label>
            <div class="controls">
                <label data-toggle="radio" class="radio-pretty inline">
                    <input name="gender" value="1" data-rules="required" type="radio"><span>男</span>
                </label>
                <label data-toggle="radio" class="radio-pretty inline">
                    <input name="gender" value="2" data-rules="required" type="radio"><span>女</span>
                </label>
            </div>
        </div>
        <div class="control-group">
            <label for="inputPassword" class="control-label">年龄：</label>
            <div class="controls">
                <input id="inputPassword" name="age" placeholder="整数，需要小于100" data-rules="required|number|lt=100" title="年龄" type="text">
            </div>
        </div>
        <div class="control-group">
            <label for="inputGender" class="control-label">地址：</label>
            <div class="controls"><span class="sui-dropdown dropdown-bordered select"><span class="dropdown-inner"><a role="button" data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <input name="city" data-rules="required" type="hidden"><i class="caret"></i><span>请选择</span></a>
                  <ul id="menu4" role="menu" aria-labelledby="drop4" class="sui-dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="bj">北京</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" value="sb">圣彼得堡</a></li>
                  </ul></span></span></div>
        </div>
        <div class="control-group">
            <label for="inputDes" class="control-label v-top">自我介绍：</label>
            <div class="controls">
                <textarea id="inputDes" name="des" placeholder="自我介绍" data-rules="required"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <button type="submit" class="sui-btn btn-primary">立即注册</button>
            </div>
        </div>
    </form>
</div>
<script>
//    $("#form-msg").validate({
//        messages: {
//            email: ["亲，你还没填邮箱呢", "邮箱不要瞎填哦"],
//            password: "亲，密码必须是6-12位哦"
//        }
//    })

//    //添加required规则
//    var required = function(value, element, param) {
//        return trim(value);
//    };
//    $.validate.setRule("required", required, function ($input) {
//        var tagName = $input[0].tagName.toUpperCase();
//        var type = $input[0].type.toUpperCase();
//        if ( type == 'CHECKBOX' || type == 'RADIO' || tagName == 'SELECT') {
//            return '请选择'
//        }
//        return '请填写'
//    });
//    //添加match规则
//    var match = function(value, element, param) {
//        value = trim(value);
//        return value == $(element).parents('form').find("[name='"+param+"']").val()
//    };
//    $.validate.setRule("match", match, '必须与$0相同');
//

</script>
