/**
 * Created by BF on 2017/5/4.
 */
function toRoute(val)
{
    var url = document.URL;
    var path = url.split('index.php');
    return path[0]+'index.php'+'/'+val;
}

/*验证手机号*/
function validePhone(phone)
{
    if(/^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/.test(phone) && phone.length==11){
        return true;
    }else{
        $.toast('手机号格式错误');
        return false;
    }
}

/*验证密码*/
function validePassword(pwd)
{
    if(/^[a-zA-Z\d_]{6,12}$/.test(pwd)){
        return true;
    }else{
        $.toast("密码为6到12位的数字或字母");
        return false;
    }
}

/*确认密码*/
function confirmpassword(comfirmpwd)
{
    var pwd1 = $('[name="pwd"]').eq(0).val();
    if(comfirmpwd!=pwd1){
        $.toast('两次密码不一致');
        return false;
    }else{
        return true;
    }
}

/*验证验证码*/
function validecode(code)
{
    if(code.length!=6){
        $.toast('验证码格式不正确');
        return false;
    }else{
        return true;
    }
}

/*登录弹框*/
function open_login(){
    $.toast('请先登录');
}

//“设置”-选择性别
$(document).on('click','#mine .create-actions', function () {
    var parent = $('.create-actions');

    var buttons1 = [
        {
            text: '请选择',
            label: true
        },
        {
            text: '男',
            bold: true,
            onClick: function() {
                parent.attr('id',1);
                parent.html('男');
            }
        },
        {
            text: '女',
            onClick: function() {
                parent.attr('id',2);
                parent.html('女');
            }
        }
    ];
    var buttons2 = [
        {
            text: '取消'
//                bg: 'danger'
        }
    ];
    var groups = [buttons1, buttons2];
    $.actions(groups);
});

//"设置"-修改密码
$(document).on('click', '#mine .prompt-title-ok',function () {
    $.prompt('新密码：', function (value) {
        $.alert('您输入的密码是："' + value + '". ');
    });
});

/*修改底部工具栏的点击事件*/
$(document).on("click",".bar-tab a",function(){
    var href = $(this).attr('rel');
    var num,title;

    switch(href){
        case "home":  //主页
            num=0;
            title='随“心”记';
            break;
        case "favourite":   //我的
            num=1;
            title="收藏";
            break;
        case "cart":   //购物车
            num=2;
            title="购物车";
            break;
        case "setting":   //设置
            num=3;
            title="设置";
            break;
    }
    $('.page-group nav').find('a.tab-item').removeClass('active'); //先移除"高亮显示"的class
    $('.page-group nav').find('a.tab-item').eq(num).addClass('active');  //高亮显示当前所在的导航标题下
    //修改顶部标题
    $('.page-group header').find('h1').html(title);
    //修改顶部导航返回键
    if(href!='home'){
        $('.page-group header').find('a').attr('class','button button-link button-nav pull-left back');
        $('.page-group header').find('a').html('<span class="icon icon-left"></span>');
    }else{
        $('.page-group header').find('a').attr('class','icon pull-left  icon-me open-popup');
        $('.page-group header').find('a').attr('data-popup','.popup-about');
        $('.page-group header').find('a').html('');
    }
    $(this).attr('href','#'+href);
});

/*右侧滑“删除”购物车*/
//$(document).on("click", "#cart li", function() {
//    //$.toast('这是一个提醒');
//    $.openPanel("#cart #panel-js-demo");
//});
//
///*关闭 “侧栏”*/
//$(document).on("click","#cart .close_panel",function(){
//    $.closePanel('#panel-js-demo');
//});