<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/3
 * Time: 13:19
 */
?>
<header class="bar bar-nav">
    <?php
    if(!empty($user)){
        $style =  $user->headImg ? 'background-image:url("'.$user->headImg.'")' : '';
        $event = ' icon-default open-panel';
    }else{
        $style = 'data-popup=".popup-about"';
        $event = ' icon-me open-popup';
    }
    ?>
    <a class="icon pull-left <?=$event?>" <?=$style?>></a>
    <!--            <a class="button button-link button-nav pull-left" href="/demos/card" data-transition='slide-out'>-->
    <!--                <span class="icon icon-left"></span>-->
    <!--                返回-->
    <!--            </a>-->


    <h1 class="title">随‘心’记</h1>
</header>


