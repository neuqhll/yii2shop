<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/10/2
 * Time: 22:05
 */

namespace app\modules\weixin\controllers;


use app\common\components\BaseWebController;

class MsgController extends BaseWebController
{
    public function actionIndex()
    {
        if(!$this->checkSignature()){
            return "error signature~~";
        }
        if(array_key_exists("echostr",$_GET) && $_GET['echostr']){
            return $_GET['echostr'];
        }

        return "succeed!";
    }
    public function checkSignature()
    {
        $signature = trim($this->get("signature",""));
        $timestamp = trim($this->get("timestamp",""));
        $nonce = trim($this->get("nonce",""));
        $tmpArr = array(\Yii::$app->params['weinxin']['token'],$timestamp,$nonce);
        sort($tmpArr,SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            return ture;
        }else{
            return false;
        }

    }
}