<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '车型管理';
$this->params['breadcrumbs'][] = $this->title;

echo Html::cssFile('@web/zTree/css/bootstrapStyle.css');
echo Html::jsFile('@web/zTree/js/jquery.ztree.core.js');
echo Html::jsFile('@web/zTree/js/jquery.ztree.excheck.js');
echo Html::jsFile('@web/zTree/js/jquery.ztree.exedit.js');
?>

<div id="content-header">
    <div id="breadcrumb">
        <a href="<?=Yii::$app->getHomeUrl()?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 主页</a>
        <a href="#" class="current">系统管理</a>
        <a href="<?=Url::toRoute('operator/role-index')?>" class="current">车型管理</a>
    </div>
</div>

<script>
    var setting = {
        async:{
            enable:true,
            url:"",
            autoParam:["ID"],
            contentType:"application/json",
            type:"get",
            dataFilter:filter
        },
        view: {
            addHoverDom: addHoverDom,
            removeHoverDom: removeHoverDom,
            selectedMulti: false  //true:不允许同时选中多个节点。
        },
        //check属性放在data属性之后，复选框不起作用
        check: {
            enable: false //是否显示复选框
        },
        data: {
            simpleData: {
                enable: true //true表示使用简单数据格式，不配置或配置为false则为标准数据格式.
            }
        },
        edit: {
            enable: true
        },
        callback: {
            beforeRemove: beforeRemove,
            beforeRename: beforeRename
        }
    };
    function filter(treeId, parentNode, childNodes) {
        if (!childNodes) return null;
        for (var i = 0, l = childNodes.length; i < l; i++) {
            childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
        }
        return childNodes;
    }
    function beforeRemove(treeId, treeNode) {
        //获取树对象
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        //选择节点
        zTree.selectNode(treeNode);

        return confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
    }
    function beforeRename(treeId, treeNode, newName) {
        if (newName.length == 0) {
            alert("节点名称不能为空!");
            return false;
        }
        return true;
    }
    var zNodes =[
        {id:1, pId:0, name:"[core] 基本功能 演示", open:true},
        {id:101, pId:1, name:"最简单的树 --  标准 JSON 数据"},
        {id:102, pId:1, name:"最简单的树 --  简单 JSON 数据"},
        {id:103, pId:1, name:"不显示 连接线"},
        {id:104, pId:1, name:"不显示 节点 图标"},
        {id:108, pId:1, name:"异步加载 节点数据"},
        {id:109, pId:1, name:"用 zTree 方法 异步加载 节点数据"},
        {id:110, pId:1, name:"用 zTree 方法 更新 节点数据"},
        {id:111, pId:1, name:"单击 节点 控制"},
        {id:112, pId:1, name:"展开 / 折叠 父节点 控制"},
        {id:113, pId:1, name:"根据 参数 查找 节点"},
        {id:114, pId:1, name:"其他 鼠标 事件监听"},
        {id:2, pId:0, name:"[excheck] 复/单选框功能 演示", open:false},
        {id:201, pId:2, name:"Checkbox 勾选操作"},
        {id:206, pId:2, name:"Checkbox nocheck 演示"},
        {id:211, pId:2, name:"Radio halfCheck 演示"},
        {id:205, pId:2, name:"用 zTree 方法 勾选 Radio"},
        {id:3, pId:0, name:"[exedit] 编辑功能 演示", open:false},
        {id:301, pId:3, name:"拖拽 节点 基本控制"},
        {id:302, pId:3, name:"拖拽 节点 高级控制"},
        {id:304, pId:3, name:"基本 增 / 删 / 改 节点"},
        {id:305, pId:3, name:"高级 增 / 删 / 改 节点"},
        {id:307, pId:3, name:"异步加载 & 编辑功能 共存"},
        {id:308, pId:3, name:"多棵树之间 的 数据交互"},
        {id:4, pId:0, name:"大数据量 演示", open:false},
        {id:401, pId:4, name:"一次性加载大数据量"},
        {id:402, pId:4, name:"分批异步加载大数据量"},
        {id:403, pId:4, name:"分批异步加载大数据量"}
    ];
    //初始化zTree生成树
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });
    var newCount = 1;
    function addHoverDom(treeId, treeNode) {
        var sObj = $("#" + treeNode.tId + "_span");
        if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
            + "' title='add node' onfocus='this.blur();'></span>";
        sObj.after(addStr);
        var btn = $("#addBtn_"+treeNode.tId);
        if (btn) btn.bind("click", function(){
            //获取树的对象
            var zTree = $.fn.zTree.getZTreeObj("treeDemo"); //参数为树的id
            //操作树：给树添加节点
            zTree.addNodes(treeNode, {id:(100 + newCount), pId:treeNode.id, name:"new node" + (newCount++)});
            return false;
        });
    }
    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_"+treeNode.tId).unbind().remove();
    }
</script>
<ul id="treeDemo" class="ztree" ></ul>
<!--<div class="container-fluid">-->
<!--    <div class="row-fluid">-->
<!--        <div class="span12">-->
<!--            <div class="widget-box">-->
<!--                <div class="widget-title">-->
<!--                    <span class="icon"><i class="icon-th"></i></span>-->
<!--                    <h5>--><?//= Html::encode($this->title);?><!--</h5>-->
<!--                </div>-->
<!--                <div class="widget-content">-->
<!--                    <p>-->
<!--                        --><?//= Html::a('添加车型', ['create'], ['class' => 'btn btn-success']) ?>
<!--                    </p>-->
<!---->

<!--                    --><?//= GridView::widget([
                    //                        'dataProvider' => $dataProvider,
                    //                        'filterModel' => $searchModel,
                    //                        'columns' => [
                    //                            ['class' => 'yii\grid\SerialColumn'],
                    //
                    //                            'c_code',
                    //                            'c_title',
                    //                            'c_parent',
                    //                            'c_logo',
                    //                            'c_level',
                    //                            'c_type',
                    //                            'c_price',
                    //                            // 'c_sortorder',
                    //                            // 'c_imgoutside',
                    //                            // 'c_imginside',
                    //                            'c_volume',
                    //                            'c_engine',
                    //
                    //                            ['class' => 'yii\grid\ActionColumn'],
                    //                        ],
                    //                    ]); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

