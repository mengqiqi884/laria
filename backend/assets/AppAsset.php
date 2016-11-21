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
        'css/site.css',
    ];
    public $js = [
        'js/jquery-1.11.1.min.js',
        'js/layer/layer.js',
//        'js/export-table/bootstrap-table-export.js',
//        'js/export-table/tableExport.js',
    ];
 //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
 //   ];
}
