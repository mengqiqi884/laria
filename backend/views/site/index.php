<?php

/* @var $this yii\web\View */

backend\assets\ChartAsset::register($this);
?>
<div id="content-header">
    <div id="breadcrumb"> <a href="<?=\yii\helpers\Url::toRoute(['site/index'])?>" title="返回主页" class="tip-bottom"><i class="icon-home"></i> 主页</a></div>
</div>
<div  class="quick-actions_homepage">
    <ul class="quick-actions">
        <li> <a href="#"> <i class="icon-dashboard"></i><i>订单: </i>352 </a> </li>
        <li> <a href="#"> <i class="icon-people"></i><i>用户: </i> 12 </a> </li>
        <li> <a href="#"> <i class="icon-search"></i> <i>车辆: </i> 5 </a> </li>
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
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function click_refresh(){
        alert(1);

    }
</script>