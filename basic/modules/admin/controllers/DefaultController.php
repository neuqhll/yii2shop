<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\controllers\base\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
