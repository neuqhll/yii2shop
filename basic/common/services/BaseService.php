<?php
namespace app\common\services;

//所有服务的基类
class BaseService{
    private static $_error_msg=null;
    private static $_error_code = null;
    public static function _err($msg = '',$code = -1){
        self::$_error_code = $code;
        self::$_error_msg = $msg;
        return false;
    }

    public static function getLastErrorMsg(){
        return self::$_error_msg;
    }

    public static function getLastErrorCode(){
        return self::$_error_code;
    }
}