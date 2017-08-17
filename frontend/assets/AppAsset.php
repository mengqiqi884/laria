<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'SUI/css/light7.min.css',   //light7是SUI的完善版本
        'SUI/css/light7-swiper.min.css', //light7是SUI的完善版本
        'SUI/css/demos.css'   //LARIA后期自己添加的样式
    ];
    public $js = [
     //   'SUI/js/jquery-2.1.4.js',
        'http://g.alicdn.com/sj/lib/zepto/zepto.min.js',

        'SUI/js/light7.min.js',  //light7与jquery没冲突
        'SUI/js/light7-swiper.min.js',
        'SUI/js/light-demos.js'

    ];
    public $depends = [
      //  'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
