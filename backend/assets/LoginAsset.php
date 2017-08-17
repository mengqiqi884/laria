<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/7/14
 * Time: 9:53
 */

namespace backend\assets;

use yii\web\AssetBundle;
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

];
    public $js = [
        'js/maruti.login.js',
//        'js/bootstrap.min.js',
        'js/jquery.uniform.js',
        'js/jquery.validate.js',
        'js/maruti.js',
        'js/form_validate/login_validation.js'
];
    //   public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        //   ];
        public $jsOptions = ['position' => \yii\web\View::POS_END];
    }
