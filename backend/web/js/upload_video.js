/**
 * Created by BF on 2017/6/15.
 */

/*上传视频*/
$("#ffilms-video").fileinput({
    uploadUrl: "http://localhost/laria/backend/web/upload/video", // server upload action
    uploadExtraData:{'filename':$('#ffilms-video').attr('name')},
    uploadAsync: true,
    minFileCount: 1,
    maxFileCount: 1,
    showUpload: true,
    browseOnZoneClick: true,
    autoReplace: true,
    initialPreviewAsData: true // identify if you are sending preview data only and not the markup
});