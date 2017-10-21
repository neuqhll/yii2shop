<?php

namespace app\controllers;

use app\common\components\BaseWebController;
use app\common\services\applog\AppLogService;
use yii\log\FileTarget;


class ErrorController extends BaseWebController
{
    public function actionError()
    {
        $err_msg ='';
        $error = \Yii::$app->errorHandler->exception;
        if ($error) {
            $file = $error->getFile();
            $line = $error->getLine();
            $message = $error->getMessage();
            $code = $error->getCode();
            $log = new FileTarget();
            $log->logFile= \Yii::$app->getRuntimePath()."/logs/err.log";

            $err_msg = $message." [file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}]
          [POST_DATA:" .http_build_query( $_POST)."]";

            $log->messages[] = [
                $err_msg,
                1,
                'application',
                microtime(true)
            ];
            //写入文件中
            $log->export();
            //写入数据库中
            AppLogService::addErrorLog(\Yii::$app->id,$err_msg);
        }
//        $this->layout = false; //消除yii统一布局
        //return $this->render("error",["err_msg" => $err_msg]); //显示完整的错误信息
        return $this->render("error",["err_msg" => $message]);
    }
}
