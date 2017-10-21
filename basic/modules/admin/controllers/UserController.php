<?php

namespace app\modules\admin\controllers;

use app\common\services\UrlService;
use app\models\User;
use app\modules\admin\controllers\base\BaseController;
use yii\helpers\Url;
use yii\web\Controller;

class UserController extends BaseController
{
    public function actionLogin()
    {
        //get请求,展示登录页面
        if(\Yii::$app->request->isGet){
        $this->layout="user";
        return $this->render("login");
        }
        $login_name = trim($this->post("login_name",""));
        $login_pwd = trim($this->post("login_pwd",""));
        //验证用户名和密码不为空
        if(!$login_name || !$login_pwd) {
            return $this->renderJs('用户名和密码不能为空!!!',UrlService::buildAdminUrl('/user/login'));
        }
        //验证用户名
        $user_info = User::find()->where(['login_name' => $login_name])->one();

        if(!$user_info){
            return $this->renderJs('请输入正确的用户名和密码!!!',UrlService::buildAdminUrl('/user/login'));
        }

        if(!$user_info->verifyPassword($login_pwd)){
            return $this->renderJs('请输入正确的用户名和密码!!!',UrlService::buildAdminUrl('/user/login'));
        }

        //保存用户的登录状态 cookies运行保存用户登录态
        $this->setLoginStatus($user_info);
        return $this->redirect(UrlService::buildAdminUrl("/dashboard"));
    }
    //编辑当前用户信息
    public function actionEdit()
    {
        if(\Yii::$app->request->isGet)
        {
            //获取当前登录人信息
            return $this->render("edit",['user_info'=>$this->current_user]);
        }
        $mobile = trim($this->post("mobile",""));
        $nickname = trim($this->post("nickname",""));
        $email = trim($this->post("email",""));

        $user_info = $this->current_user;
        $user_info->mobile = $mobile;
        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);
        return $this->renderJson([],"修改信息成功!");

    }
    //修改密码
    public function  actionResetPwd()
    {
        if(\Yii::$app->request->isGet){
            return $this->render("reset_pwd",['user_info'=>$this->current_user]);
        }

        $old_password = trim($this->post("old_password",""));
        $new_password = trim($this->post("new_password",""));

        if( mb_strlen($old_password,"utf-8")<1) {
            return $this->renderJson([],"请输入原密码~~",-1);
        }

        if($old_password == $new_password){
            return $this->renderJson([],"原密码和新密码不能相同,请重新输入!",-1);
        }

        //判断原密码是否正确
        //密码加密算法 = md5(login_pwd+md5(login_salt))
        $user_info = $this->current_user;
        if(!$user_info->verifyPassword($old_password)){
            return $this->renderJson([],"原密码错误,请重新输入!");
        }
        $user_info->setPassword($new_password);
        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update(0);
        $this->setLoginStatus($user_info); //更新cookie
        $this->renderJson([],"密码重置成功!");
    }
    public function actionLogout()
    {
        $this->removeAuthToken();
        return $this->redirect(UrlService::buildAdminUrl("/user/login"));
    }
}
