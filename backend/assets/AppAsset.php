<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
        'css/bootstrap.css',
        'css/bootstrap.min.css',
		'css/bootstrap-responsive.min.css',
        'css/uniform.css',
        'css/maruti-login.css'
    ];
    public $js = [
//                'js/jquery-1.11.1.min.js',
        'js/jquery.min.js',
        'js/layer/layer.js',
        'js/jquery.ui.custom.js',


//        'js/layer/layer.js',
       // 'js/jquery.resizableColimns.js'  //可对表格列宽进行拖拽(此框架自带此功能)
    ];
 //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
 //   ];
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
}
