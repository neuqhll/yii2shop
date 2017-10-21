<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/9/10
 * Time: 15:27
 */

namespace app\common\services;


use yii\helpers\Url;

class UrlService
{
    //构建admin所有的链接
    public static function buildAdminUrl($path,$params=[]){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['admin'].$path;
    }
    //构建会员user的链接
    public static function buildUserUrl($path,$params=[]){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['user'].$path;
    }
    //构建官网链接
    public static function buildWwwUrl($path,$params =[]){
        $domain_config = \Yii::$app->params['domain'];
        $path=Url::toRoute(array_merge([$path],$params));
        return $domain_config['www'].$path;
    }
    //空连接
    public static function buildNullUrl(){
        return "javascript:void(0)";
    }

    public static function buildPicUrl($bucket,$image_key){
        $domain_config = \Yii::$app->params['domain'];
        $upload_config = \Yii::$app->params['upload'];
        return $domain_config['www'].$upload_config[$bucket].$image_key;
    }

}