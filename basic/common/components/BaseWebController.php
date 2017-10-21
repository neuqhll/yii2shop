<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/9/10
 * Time: 10:46
 */

namespace app\common\components;

use yii\web\Controller;

class BaseWebController extends Controller
{
    public $enableCsrfValidation = false;
    //获取http的get参数
    public function get($key,$default_val="")
    {
        return \Yii::$app->request->get($key,$default_val);
    }
    //获取http的post参数
    public function post($key,$default_val="")
    {
        return \Yii::$app->request->post($key,$default_val);
    }

    //设置cookie值
    public function setCookie($name,$value,$expire = 0)
    {
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name'=>$name,
            'value'=>$value,
            'expire'=>$expire
        ]));
    }
    //获取cookie
    public function getCookie($name,$default_val='')
    {
        $cookies = \Yii::$app->request->cookies;
        return $cookies->getValue($name,$default_val);
    }
    //删除cookie
    public function removeCookie($name)
    {
        $cookies=\Yii::$app->response->cookies;
        $cookies->remove($name);
    }
    //返回统一json格式方法
    protected function renderJson($data = [],$msg = "ok",$code= 200)
    {
        header("Content-type: application/json");
        echo json_encode([
            "code"=>$code,
            "msg"=>$msg,
            "data"=>$data,
            "req_id"=>uniqid(),
        ]);
        return \Yii::$app->end();
    }
    //统一js提醒格式
    public function renderJs($msg,$url="/")
    {
        return $this->renderPartial("@app/views/common/js",['msg'=>$msg,'url'=>$url]);
    }

}