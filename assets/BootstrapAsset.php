<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/material.min.css',
//        'https://fonts.googleapis.com/icon?family=Material+Icons',
//        "/css/custom/bootstrap.css",
        "/css/custom/bootstrap.min.css",
        "/css/font-awesome.css"
    ];
    public $js = [
        "/js/bootstrap.min.js"
    ];
    public $depends = [
//        '\app\assets\AppAsset',
    ];
}
