<?php

/* @var $this yii\web\View */

backend\assets\ChartAsset::register($this);
?>
<div id="content-header">
    <div id="breadcrumb"> <a href="<?=\yii\helpers\Url::toRoute(['site/index'])?>" title="返回主页" class="tip-bottom"><i class="icon-home"></i> 主页</a></div>
</div>
<div  class="quick-actions_homepage">
    <ul class="quick-actions">
        <li> <a href="#"> <i class="icon-dashboard"></i><i>订单: </i><?=$ordercount?> </a> </li>
        <li> <a href="#"> <i class="icon-people"></i><i>用户: </i> <?=$usercount?> </a> </li>
        <li> <a href="#"> <i class="icon-search"></i> <i>车辆: </i> <?=$carcount?> </a> </li>
    </ul>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-signal"></i>
                    </span>
                    <h5>数据统计</h5>
                    <div class="buttons">
                        <a class="btn btn-mini" onclick="click_refresh()">
                            <i class="icon-refresh"></i>
                            刷新
                        </a>
                    </div>
                </div>
                <?php if($this->beginCache('widget-content')) { //片段缓存?>
                <div class="widget-content" id="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="chart"></div>
                        </div>
                    </div>
                </div>
                <?php
                    $this->endCache();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function click_refresh(){
        alert(1);
    }

    $(function(){

        // === 图表准备 === //
        maruti.peity();

        // === 获取图表数据 ===/
        var number = [];

        $.ajax({
            type:'POST',
            url:toRoute('site/ajax-get-charts-data'),
            data:'',
            dataType: "json", //表示返回值类型，不必须
            async:false, //同步数据
            success:function(data){
                if(data.status == '200'){
                    number = data.data; //给全局变量赋值
                }
            }
        });

        // === 制作折线图表 === //
        var plot = $.plot($(".chart"),
            [
                { data: number, label: "新注册用户数", color: "#ee7951"},
//                { data: cos, label: "cos(x)",color: "#4fb9f0" }
            ], {
                series: {
                    lines: { show: true },
                    points: { show: true }
                },
                grid: { hoverable: true, clickable: true },
//                yaxis: { min: -1.6, max: 1.6 }
            });

        // === 鼠标移动事件 === //
        var previousPoint = null;
        $(".chart").bind("plothover", function (event, pos, item) {

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $('#tooltip').fadeOut(200,function(){
                        $(this).remove();
                    });
                    var x = item.datapoint[0].toFixed(0), //保留0位小数
                        y = item.datapoint[1].toFixed(0);

                    maruti.flot_tooltip(item.pageX, item.pageY,x + "月份" + item.series.label + " ： " + y + "人");
                }

            } else {
                $('#tooltip').fadeOut(200,function(){
                    $(this).remove();
                });
                previousPoint = null;
            }
        });

        // === 鼠标点击事件 === //
        $(".chart").bind("plotclick",function(event,pos,item){
            if(item){
                plot.highlight(item.series,item.datapoint);
            }
        })
    })
</script>