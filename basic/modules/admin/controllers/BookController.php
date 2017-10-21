<?php

namespace app\modules\admin\controllers;

use app\modules\admin\controllers\base\BaseController;

class BookController extends BaseController
{
    //图书列表
    public function actionIndex()
    {
        return $this->render("index");
    }
    //图书编辑或添加
    public function actionSet()
    {
        return $this->render("set");
    }
    //图书详情
    public function actionInfo()
    {
        return $this->render("info");
    }
    //图书图片
    public function actionImages()
    {
        return $this->render("images");
    }
    //图书分类
    public function actionCat()
    {
        return $this->render("cat");
    }
    //图书分类管理
    public function actionCat_set()
    {
        return $this->render("cat_set");
    }

}
