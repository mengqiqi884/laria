<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fullcalendar.css',
        'css/maruti-style.css',
        'css/maruti-media.css'
    ];
    public $js = [
        'js/excanvas.min.js',
        'js/bootstrap.min.js',
        'js/jquery.flot.min.js',
        'js/jquery.flot.resize.min.js',
        'js/jquery.peity.min.js',   //折线图
//        'js/fullcalendar.min.js',
        'js/maruti.js',
//        'js/maruti.chat.js'
    ];
    //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    //   ];
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
}
