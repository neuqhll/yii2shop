<?php

namespace app\modules\user\controllers;

use app\modules\user\controllers\base\BaseController;

class PayController extends BaseController
{
    public function actionBuy()
    {
        return $this->render('buy');
    }
}
