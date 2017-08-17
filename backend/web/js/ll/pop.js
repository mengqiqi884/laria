/**
 * Created by BF on 2017/7/17.
 */

$(function(){
    $('.update').click(function () {
        showPage($(this));
    });

    function showPage(obj) {
        //$.fn.modal.Constructor.prototype.enforceFocus = function () { }; //防止select2无法输入
        $.get(obj.attr("data-url"), {},
            function (data) {
                $(".modal-body").html(data);
            }
        );
    }
});