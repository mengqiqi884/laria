/**
 * Created by BF on 2017/5/3.
 */

/*登录*/
function getLogin() {
    var account = $('[name=account]').val();
    var pwd = $('[name=pwd]').val();

    if(account=='' || account==null || pwd =='' || pwd==null){
        $.toast('用户名或密码不能为空');
    }else{
        var userform = {};
        userform['username'] = account;
        userform['password'] =pwd;

        $.showIndicator();   //加载迷你指示器
        //检测该用户是否存在
        $.post(toRoute(['site/ajax-login']),{LoginForm:userform},function(data){
            $.hideIndicator(); //隐藏

            if(data.status=='400'){
                $.toast(data.message);
            }else if(data.status=='200'){
                // $.router.back(); //返回上一页
                $.toast('登录成功');
                location.reload();
            }
        },'json');
    }

}

/*获取验证码*/
function getCode(num)
{
    var account = $('[name="account"]').val();
    if(account.length!=11){
        $.toast('手机号格式不正确');
        return false;
    }else{
        $.showIndicator(); //加载框

        $.post(toRoute('site/smser'),{account:account,type:num},function(data){

            $.hideIndicator();

            if(data.status=='400'){
                $.toast(data.message);
            }else{
                $.alert('【laria】您的验证码：'+data.message+',请及时注册，30分钟内有效','短信验证码，发送成功');
            }
        },'json');
    }
}

/*注册*/
function getRegister()
{
    var account = $('[name="account"]').val();
    var pwd = $('[name="pwd"]').val();
    var code = $('[name="code"]').val();

    $.showIndicator(); //加载框

    $.post(toRoute('site/ajax-register'),{account:account,password:pwd,code:code},function(data){
        $.hideIndicator();

        if(data.status=='400'){
            $.toast(data.message);
        }else if(data.status=='200'){
            $.router.back(); //返回上一页
        }
    },'json');
}
