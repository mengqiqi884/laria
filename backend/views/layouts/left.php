<?
use dmstr\widgets\Menu;
use mdm\admin\components\MenuHelper;
?>
<!--<aside class="main-sidebar">-->
<!--    <section class="sidebar">-->
<!--        <div class="user-panel">-->
<!--            <div class="pull-left image">-->
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
<!--            </div>-->
<!--            <div class="pull-left info">-->
<!--                <p>--><?//=$user->username?><!--</p>-->
<!--                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="查找..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
<!--       -->
        <?php
            $callback = function($menu){
                $data = json_decode($menu['mam_data'], true);
                $items = $menu['children'];
                $return = [
                    'label' => $menu['mam_name'],
                    'url' => [$menu['mam_route']],
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
<!---->
<!--        --><?//=Menu::widget(
//            [
//                "encodeLabels" => false,
//                "options" => ["class" => "sidebar-menu"],
//                'items' =>MenuHelper::getAssignedMenu($user->id,null, $callback),
//            ]
//        );
//        ?>
<!--    </section>-->
<!---->
<!--</aside>-->

<div id="sidebar">
    <?=Menu::widget(
                [
                    "encodeLabels" => false,
                    "options" => ["class" => "sidebar-menu"],
                    'items' =>MenuHelper::getAssignedMenu($user->a_id,null, $callback),
                ]
            );
    ?>
<!--    <ul>-->
<!--        <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>-->
<!--        <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>-->
<!--        <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>-->
<!--        <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>-->
<!--        <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>-->
<!--        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label">3</span></a>-->
<!--            <ul>-->
<!--                <li><a href="form-common.html">Basic Form</a></li>-->
<!--                <li><a href="form-validation.html">Form with Validation</a></li>-->
<!--                <li><a href="form-wizard.html">Form with Wizard</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>-->
<!--        <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>-->
<!---->
<!--        <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label">3</span></a>-->
<!--            <ul>-->
<!--                <li><a href="gallery.html">Gallery</a></li>-->
<!--                <li><a href="calendar.html">Calendar</a></li>-->
<!--                <li><a href="chat.html">Chat option</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!---->
<!--    </ul>-->
</div>
