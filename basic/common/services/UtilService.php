<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/9/11
 * Time: 16:43
 */

namespace app\common\services;

use yii\helpers\Html;

class UtilService
{
    public static function getIP()
    {
        if(!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])){
            return $_SERVER['HTTP_X_FORWARDED_PROTO'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function encode($str)
    {
        $string = Html::decode($str);
        return  $string;
    }

    public static function getRootPath()
    {
        return dirname(\Yii::$app->vendorPath);
    }
}