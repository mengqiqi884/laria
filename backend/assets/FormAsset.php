<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/7/20
 * Time: 14:15
 */

namespace backend\assets;


use yii\web\AssetBundle;

class FormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/colorpicker.css',
        'css/datepicker.css',
        'css/uniform.css',
        'css/select2.css',
        'css/maruti-media.css',
    ];
    public $js = [
//        'js/jquery.min.js',
//        'js/jquery.ui.custom.js',
//        'js/bootstrap.min.js',
        'js/bootstrap-colorpicker.js',
        'js/bootstrap-datepicker.js',
        'js/jquery.uniform.js',
        'js/select2.min.js',
//        'js/maruti.js',
        'js/maruti.form_common.js'

    ];
    //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    //   ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}