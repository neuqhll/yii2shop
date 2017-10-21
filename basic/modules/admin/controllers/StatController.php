<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\controllers\base\BaseController;


class StatController extends BaseController
{
    //统计主页
    public function actionIndex()
    {
        return $this->render("index");
    }
    //会员消费统计
    public function actionMember()
    {
        return $this->render("member");
    }
    //商品销售统计
    public function actionProduct()
    {
        return $this->render("product");
    }
    //分享统计
    public function actionShare()
    {
        return $this->render("share");
    }
}
