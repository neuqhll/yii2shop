<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public function registerAssetFiles($view)
    {
        //加一个版本号
        //目的：使浏览器获取最新的文件
        $release = "20170910";
        $this->css = [
        'font-awesome/css/font-awesome.css',
        'css/user/css_style.css',
        'css/user/app.css?ver='.$release,
    ];
        $this->js = [
        'plugins/jquery-2.1.1.js',
        'js/user/TouchSlide.1.1.js',
        'js/user/common.js?ver='.$release,
    ];
        $this->depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

        parent::registerAssetFiles($view);
    }


}
