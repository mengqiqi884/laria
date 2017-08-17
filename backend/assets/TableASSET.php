<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/7/17
 * Time: 9:44
 */

namespace backend\assets;

use yii\web\AssetBundle;

class TableAsset extends  AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/uniform.css',
        'css/select2.css'
    ];
    public $js = [
        'js/jquery.uniform.js',
        'js/select2.min.js',
        'js/maruti.tables.js',
        'js/jquery.dataTables.min.js',
        'js/jquery.gritter.min.js',
        'js/ll/pop.js'
    ];
    //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    //   ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}