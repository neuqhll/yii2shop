<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use app\modules\admin\controllers\base\BaseController;

class DashboardController extends BaseController
{
    //仪表盘主页面
    public function actionIndex()
    {
        return $this->render("index");
    }
}
