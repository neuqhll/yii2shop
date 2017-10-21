<?php

namespace app\modules\user\controllers\base;

use app\common\components\BaseWebController;

class BaseController extends BaseWebController
{
    public function __construct($id,$module,array $config=[])
    {
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }

    public function beforeAction($action)
    {
        return true;
    }
}
