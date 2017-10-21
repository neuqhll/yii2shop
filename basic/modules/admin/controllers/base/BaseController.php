<?php

namespace app\modules\admin\controllers\base;

use app\common\components\BaseWebController;
use app\common\services\applog\AppLogService;
use app\common\services\UrlService;
use app\models\User;

class BaseController extends BaseWebController
{
    protected $auth_cookie_name = "book";
    protected $page_size = 50;
    protected $current_user = null;

    public $allowAllAction = [
        'admin/user/login',
        'admin/user/login_out',
    ];

    //指定特定的布局文件
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    //登录统一验证
    public function beforeAction( $action )
    {
        $is_login = $this->checkLoginStatus();
        if (in_array($action->getUniqueId(), $this->allowAllAction)) {
            return true;
        }

        if (!$is_login) {
            if (\Yii::$app->request->isAjax) {
                 $this->renderJson([], "未登录,请返回登录页面重新登录!", -320);
            }
              else {
                 $this->redirect(UrlService::buildAdminUrl("/user/login"));
              }
            return false;
        }
        //记录所有用户的访问
        AppLogService::addAppAccessLog($this->current_user['uid']);
        return true;
    }


    //验证当前登录状态是否有效
    private function checkLoginStatus()
    {
        //验证cookie是否存在
        $auth_cookie = $this->getCookie($this->auth_cookie_name, "");
        if (!$auth_cookie) {
            return false;
        }
        //验证加密字符串和用户id是否为空
        list($auth_taken, $uid) = explode("#", $auth_cookie);
        if (!$auth_cookie || !$uid) {
            return false;
        }
        //验证用户id是否为数字
        if (!preg_match("/^([0-9])+$/", $uid)) {
            return false;
        }
        //验证用户信息是否存在
        $user_info = User::find()->where(['uid' => $uid])->one();
        if (!$user_info) {
            return false;
        }

        //验证网页上的加密字符串与经过数据库中数据计算得出的加密字符串是否一致

        if ($auth_taken != $this->geneAuthTaken($user_info)) {
            return false;
        }

        $this->current_user=$user_info;
        \Yii::$app->view->params['current_user'] = $user_info;

        //AppLogService::addAppLog($this->current_user['uid']);
        return true;
    }

    //设置登录态的方法 加密字符串+“#”+uid,加密字符串md5（login_name+login_pwd+login_salt）
    public function setLoginStatus($user_info)
    {
        $auth_token = $this->geneAuthTaken($user_info);
        $this->setCookie($this->auth_cookie_name, $auth_token . "#" . $user_info['uid']);
    }

    //统一生成加密字段,加密字符串md5（login_name+login_pwd+login_salt)
    public function geneAuthTaken($user_info)
    {
        return md5($user_info['login_name'] . $user_info['login_pwd'] . $user_info['login_salt']);
    }

    //清除Cookie
    public function removeAuthToken()
    {
        $this->removeCookie($this->auth_cookie_name);
    }


}
