<?php

namespace app\controllers;

use app\common\components\BaseWebController;
use Yii;


class DefaultController extends BaseWebController
{
    public function actionIndex()
    {
        //$this->layout = false;  //取消yii统一布局
        return $this->render("index");
    }
}
