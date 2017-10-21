<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use app\modules\admin\controllers\base\BaseController;

class FinanceController extends BaseController
{
    //订单列表
    public function actionIndex()
    {
        return $this->render("index");
    }
    //财务流水
    public function actionAccount()
    {
        return $this->render("account");
    }
    //订单付款信息
    public function actionPay_info()
    {
        return $this->render("pay_info");
    }


}
