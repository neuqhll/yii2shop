<?php

namespace app\modules\user\controllers;

use app\modules\user\controllers\base\BaseController;

class ProductController extends BaseController
{
    //商品列表
    public function actionIndex()
    {
        return $this->render('index');
    }
    //商品详情
    public function actionInfo()
    {
        return $this->render('info');
    }
    //商品控制
    public function actionOrder()
    {
        return $this->render('order');
    }
}
