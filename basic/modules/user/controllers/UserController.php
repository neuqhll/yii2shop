<?php

namespace app\modules\user\controllers;

use app\modules\user\controllers\base\BaseController;

class UserController extends BaseController
{
    //账号详情
    public function actionIndex()
    {
        return $this->render('index');
    }
    //账号绑定
    public function actionBind()
    {
        return $this->render('bind');
    }
    //账号收货地址
    public function actionAddress()
    {
        return $this->render('address');
    }
    //账号收货地址设置
    public function actionAddress_set()
    {
        return $this->render('address_set');
    }
    //账号购物车
    public function actionCart()
    {
        return $this->render('cart');
    }
    //账号信息
    public function actionComment()
    {
        return $this->render('comment');
    }
    //账号信息设置
    public function actionComment_set()
    {
        return $this->render('comment_set');
    }
    //账号订单详情
    public function actionOrder()
    {
        return $this->render('order');
    }
    //账号收藏
    public function actionFav()
    {
        return $this->render('fav');
    }
}
