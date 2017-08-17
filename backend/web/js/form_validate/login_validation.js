/**
 * Created by BF on 2017/7/14.
 */
/**
 * Unicorn Admin Template
 * Diablo9983 -> diablo9983@gmail.com
 **/
$(document).ready(function(){
    // Form Validation
    $("#loginform").validate({
        rules:{
            username:{
                required:true
            },
            pwd:{
                required:true,
                rangelength: [5,12]
                //equalTo:"#pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    //$("#password_validate").validate({
    //    rules:{
    //        pwd:{
    //            required: true,
    //            minlength:6,
    //            maxlength:20
    //        },
    //        pwd2:{
    //            required:true,
    //            minlength:6,
    //            maxlength:20,
    //            equalTo:"#pwd"
    //        }
    //    },
    //    errorClass: "help-inline",
    //    errorElement: "span",
    //    highlight:function(element, errorClass, validClass) {
    //        $(element).parents('.control-group').addClass('error');
    //    },
    //    unhighlight: function(element, errorClass, validClass) {
    //        $(element).parents('.control-group').removeClass('error');
    //        $(element).parents('.control-group').addClass('success');
    //    }
    //});
});
