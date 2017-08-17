<?php
/**
 * Created by PhpStorm.
 * User: BF
 * Date: 2017/7/13
 * Time: 16:34
 */

namespace backend\assets;

use yii\web\AssetBundle;

class ChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [];
    public $js = [
        'js/maruti.dashboard.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}