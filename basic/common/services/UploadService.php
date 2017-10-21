<?php
namespace app\common\services;
//上传服务
class UploadService extends BaseService
{
    public static function uploadByFile($file_name,$file_path,$bucket = ''){
        if(!$file_name){
            return self::_err("参数文件名是必须的!");
        }
        if(!$file_path ){
            return self::_err("路径不能为空!");
        }
        if(!file_exists($file_path)){
            return self::_err("路径重复,请重新输入!");
        }
        $upload_config = \Yii::$app->params['upload'];
        if( !isset( $upload_config[ $bucket ] ) ){
        return self::_err("指定参数的bucket错误!");
        }

        $date_now = date("Y-m-d H:i:s");
        $tmp_file_extent = explode(".",$file_name);
        $file_type = strtolower(end($tmp_file_extent));

        $hash_key = md5($file_path);

        //按照日期放置图片
        $upload_dir_path = UtilService::getRootPath() ."/web". $upload_config[$bucket];
        $folder_name = date("Ymd",strtotime($date_now));
        $upload_dir = $upload_dir_path.$folder_name;
        if(!file_exists($upload_dir)){
            mkdir($upload_dir,0777);
            chmod($upload_dir,0777);
        }

        $upload_full_name = $folder_name ."/". $hash_key .".". $file_type;

        if(is_uploaded_file($file_path)){
            move_uploaded_file($file_path,$upload_dir_path.$upload_full_name);
        }else{
            file_put_contents($file_path,$upload_dir_path,file_get_contents($file_name));
        }
        return [
            'code' => 200,
            'path' => $upload_full_name,
            'prefix' => $upload_config[$bucket],
        ];
    }
}