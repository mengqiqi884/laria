<?php
    //\frontend\assets\VideoAsset::register($this);
?>

<div class="page" id="index">
    <!--内容部分-->
    <!-- content应该拥有"pull-to-refresh-content"类,表示启用下拉刷新 -->
    <div class="content pull-to-refresh-content" data-ptr-distance="55">
        <!-- 默认的下拉刷新层 -->
        <div class="pull-to-refresh-layer">
            <div class="preloader"></div>
            <div class="pull-to-refresh-arrow"></div>
        </div>
        <!--下面是正文-->
        <div class="card-container">
            <div class="page-index">
                <div class="card">
                    <div class="card-header color-white no-border">
                        视频测试测试
                    </div>
                    <div class="card-content">
                        <video id="example_video_1" class="video-js vjs-default-skin" controls="controls" preload="auto" width="640" height="126" poster="http://vjs.zencdn.net/v/oceans.png" data-setup="{}">
                            <source src="http://vjs.zencdn.net/v/oceans.mp4" type="video/mp4">
                            <source src="http://vjs.zencdn.net/v/oceans.webm" type="video/webm">
                            <source src="http://vjs.zencdn.net/v/oceans.ogv" type="video/ogg">
<!--                            <track kind="captions" src="../shared/example-captions.vtt" srclang="en" label="English"></track>-->
                            <!-- Tracks need an ending tag thanks to IE9 -->
<!--                            <track kind="subtitles" src="../shared/example-captions.vtt" srclang="en" label="English"></track>-->
                            <!-- Tracks need an ending tag thanks to IE9 -->
                            <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                        </video>
                        <div class="card-content-inner">
                            <p class="color-gray">发表于 2016/07/01</p>
                            <p>测试测试测试</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header color-white no-border">
                        R居家馆 高档床上用品4件套纯棉 床单式提花四件套 全棉贡缎 欧式
                    </div>
                    <div class="card-content">
                        <img src="<?=\yii\helpers\Url::to('@web/SUI/image/data-img/12.jpg')?>" width="100%">
                        <div class="card-content-inner">
                            <p class="color-gray">发表于 2015/01/15</p>
                            <p>纯棉纯棉纯棉。。。柔软舒适</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="link">赞(2)</a>
                        <a href="#" class="link">评论(43)</a>
                        <a href="#" class="link">更多</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header color-white no-border">
                        ROZENE
                    </div>
                    <div class="card-content">
                        <img src="//gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" alt="" width="100%">
                        <div class="card-content-inner">
                            <p class="color-gray">发表于 2015/01/15</p>
                            <p>此处是内容...</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="#" class="link">赞</a>
                        <a href="#" class="link">评论</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->render('favourite.php')?>
<?=$this->render('cart.php')?>
<?=$this->render('setting.php')?>

<script>
    //解决IE不能播放的问题很简单,将视频替换为传统的以FLASH形式播放
    if (navigator.userAgent.indexOf('MSIE') >= 0){
        document.getElementById("videoDiv").innerHTML='<embed src="Wildlife.mp4" autostart="true" loop="true" width="640" height="480" >';
    }

    //下拉刷新
    // 添加'refresh'监听器
    $(document).on('refresh', '.pull-to-refresh-content',function(e) {
        // 模拟2s的加载过程
        setTimeout(function() {
            var cardNumber = $(e.target).find('.card').length + 1;
            var cardHTML =  '<div class="card">'+
                '<div class="card-header color-white no-border">card'+cardNumber+
                '</div>'+
                '<div class="card-content">'+
                    '<img src="//gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg" alt="" width="100%">'+
                    '<div class="card-content-inner">'+
                        '<p class="color-gray">发表于 2015/01/15</p>'+
                        '<p>此处是内容'+cardNumber+'...</p>'+
                    '</div>'+
                '</div>'+
                '<div class="card-footer">'+
                    '<a href="#" class="link">赞</a>'+
                    '<a href="#" class="link">评论</a>'+
                '</div>'+
            '</div>';
            $(e.target).find('.card-container').prepend(cardHTML);
            // 加载完毕需要重置特定的下拉刷新界面
            $.pullToRefreshDone('.pull-to-refresh-content');
        }, 2000);
    });
</script>