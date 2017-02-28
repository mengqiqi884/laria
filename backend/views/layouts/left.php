<?
use dmstr\widgets\Menu;
use mdm\admin\components\MenuHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=$user->username?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="查找..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
            $callback = function($menu){
                $data = json_decode($menu['data'], true);
                $items = $menu['children'];
                $return = [
                    'label' => $menu['name'],
                    'url' => [$menu['route']],
                ];
                //处理我们的配置
                if ($data) {
                    //visible
                    isset($data['visible']) && $return['visible'] = $data['visible'];
                    //icon
                    isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                    //other attribute e.g. class...
                    $return['options'] = $data;
                }
                //没配置图标的显示默认图标
//                (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
                (!isset($return['icon']) || !$return['icon']) &&  $return['icon'] = 'fa fa-diamond';
                $items && $return['items'] = $items;
                return $return;
            };
        ?>
        <?=Menu::widget(
            [
                "encodeLabels" => false,
                "options" => ["class" => "sidebar-menu"],
                'items' =>MenuHelper::getAssignedMenu($user->id,null, $callback),
            ]
        );
        ?>

<!--        <ul class="sidebar-menu">-->
<!--            <li class="treeview">-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-gears"></i> <span>系统设置</span>-->
<!--                    <i class="fa fa-angle-left pull-right"></i>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li class="treeview">-->
<!--                        <a href="/admin">管理员 <i class="fa fa-angle-left pull-right"></i></a>-->
<!--                        <ul class="treeview-menu">-->
<!--                            <li><a href="/user"><i class="fa fa-circle-o"></i> 后台用户</a></li>-->
<!--                            <li class="treeview">-->
<!--                                <a href="/admin/role">-->
<!--                                    <i class="fa fa-circle-o"></i> 权限-->
<!--                                </a>-->
<!--                                <ul class="treeview-menu">-->
<!--                                    <li><a href="--><?//=Yii::$app->homeUrl.'admin/route'?><!--"><i class="fa fa-circle-o"></i> 路由</a></li>-->
<!--                                    <li><a href="--><?//=Yii::$app->homeUrl.'admin/permission'?><!--"><i class="fa fa-circle-o"></i> 权限</a></li>-->
<!--                                    <li><a href="--><?//=Yii::$app->homeUrl.'admin/role'?><!--"><i class="fa fa-circle-o"></i> 角色</a></li>-->
<!--                                    <li><a href="--><?//=Yii::$app->homeUrl.'admin/assignment'?><!--"><i class="fa fa-circle-o"></i> 分配</a></li>-->
<!--                                    <li><a href="--><?//=Yii::$app->homeUrl.'admin/menu'?><!--"><i class="fa fa-circle-o"></i> 菜单</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->
<!---->
    </section>

</aside>
