/**
 * Unicorn Admin Template
 * Diablo9983 -> diablo9983@gmail.com
**/
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
  //  $('.datepicker').datepicker();
});

function checkInput()
{
    var act = $('input[name="actions"]').val();  //操作：yes:新建 no:编辑
    var img = $('input[type="file"]').val(); //广告图
    var location = $("#cbanner-b_location").find("option:selected").val(); //广告图位置
    var url = $('input[name="CBanner[b_url]"]').val(); //跳转地址
    var sort = $('input[name="CBanner[b_sortorder]"]').val(); //广告图排序

    if(act=='yes' && (location=='' || location==null || location=="undefined")){
        layer.msg('请选择广告图的位置'); return false;
    }
    if(act=='yes' && (img=='' || img==null || img=="undefined")){
        layer.msg('请上传图片'); return false;
    }

    if(sort == '' || sort == null || sort == "undefined"){
        layer.msg('请输入当前广告图的的排序'); return false;
    }

    if(url!=''){

        //判断URL地址的正则表达式为:http(s)?://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?
        //下面的代码中应用了转义字符"\"输出一个字符"/"
        var strReg = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w-.\/?%&=]*)?/;
        var objExp=new RegExp(strReg);
        if(!objExp.test(url)){
            layer.msg("广告图跳转链接格式不正确！请重新输入");
            return false;
        }
    }
    return true;
}
