<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/16
 * Time: 9:48
 */
?>
<div class="page" id="favourite">
    <!--内容部分-->
    <div class="content infinite-scroll infinite-scroll-bottom ">
        <!--底部无限滚动 data-distance 指距离底部多远时触发无限滚动事件-->
        <div id="page-infinite-scroll-bottom" class="content-block empty-top" data-distance="100">
            <div class="list-block empty-top">
                <ul class="list-container">
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item1
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item2
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item3
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item4
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item3
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item4
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item5
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item6
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item7
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">
                                Item8
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- 加载提示符 -->
            <div class="infinite-scroll-preloader">
                <div class="preloader"></div>
            </div>
        </div>
    </div>
</div>

<!--<script>-->
<!--    //"我的收藏"无限滚动-->
<!---->
<!--    // 加载flag-->
<!--    var loading = false;-->
<!--    // 每次加载添加多少条目-->
<!--    var itemsPerLoad = 20;-->
<!--    // 最多可加载的条目-->
<!--    var maxItems = 100;-->
<!--    //上次加载的序号-->
<!--    var lastIndex = $('.list-container li').length;-->
<!---->
<!--    function addItems(number, lastIndex) {-->
<!--        // 生成新条目的HTML-->
<!--        var html = '';-->
<!--        for (var i = lastIndex + 1; i <= lastIndex + number; i++) {-->
<!--            html += '<li class="item-content">' +-->
<!--                '<div class="item-inner">' +-->
<!--                '<div class="item-title">' +-->
<!--                '新条目' +-->
<!--                '</div>' +-->
<!--                '</div>' +-->
<!--                '</li>';-->
<!--        }-->
<!--        // 添加新条目-->
<!--        $('.infinite-scroll .list-container').append(html);-->
<!--    }-->
<!--    $(document).on('infinite','.infinite-scroll-bottom', function() {-->
<!--        // 如果正在加载，则退出-->
<!--        if (loading) return;-->
<!--        // 设置flag-->
<!--        loading = true;-->
<!--        // 模拟1s的加载过程-->
<!--        setTimeout(function() {-->
<!--            // 重置加载flag-->
<!--            loading = false;-->
<!--            if (lastIndex >= maxItems) {-->
<!--                // 加载完毕，则注销无限加载事件，以防不必要的加载-->
<!--                $.detachInfiniteScroll($('.infinite-scroll'));-->
<!--                // 删除加载提示符-->
<!--                $('.infinite-scroll-preloader').remove();-->
<!--                return;-->
<!--            }-->
<!--            //添加新条目-->
<!--            addItems(itemsPerLoad,lastIndex);-->
<!--            // 更新最后加载的序号-->
<!--            lastIndex = $('.list-container li').length;-->
<!--            //容器发生改变,如果是js滚动，需要刷新滚动-->
<!--          //  $.refreshScroller();-->
<!--        }, 1000);-->
<!--    });-->
<!--</script>-->