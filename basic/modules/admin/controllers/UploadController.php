<?php

namespace app\modules\admin\controllers;

use app\common\services\UploadService;
use app\modules\user\controllers\base\BaseController;

class  UploadController extends BaseController {
    protected $allow_file_type = ["jpg","gif","jpeg","png"];
    //上传接口

    public function actionPic()
    {
        $bucket = $this->post('bucket','');
        $type = $this->post('type');
        $callback = "window.parent.upload";
        if(!$_FILES || !isset($_FILES["pic"])){
            return "<script>{$callback}.error(\"请提交文件之后再提交!\")</script>";
        }
        $file_name = $_FILES["pic"]["name"];
        $tmo_file_extend = explode(".",$file_name);

        if(!in_array(strtolower(end($tmo_file_extend)),$this->allow_file_type)){
            return "<script>{$callback}.error(\"请上传png,gif,jpg,jpeg类型的图片!\")</script>";
        }

        $ret = UploadService::uploadByFile($file_name,$_FILES["pic"]["tmp_name"],$bucket);
        if(!$ret){
            return "<script>{$callback}.error('".UploadService::getLastErrorMsg()."')</script>";
        }

        return "<script>{$callback}.success('{$ret['path']}','{$type}')</script>";

    }
}