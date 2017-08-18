<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/5/3
 * Time: 17:09
 */
namespace frontend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'SUI/js/login.js',
        'SUI/js/common.js',
    ];

}