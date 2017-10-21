<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use app\modules\admin\controllers\base\BaseController;

class QrcodeController extends BaseController
{
    //二维码列表
    public function actionIndex()
    {
        return $this->render("index");
    }
    //二维码编辑或添加
    public function actionSet()
    {
        return $this->render("set");
    }
}
