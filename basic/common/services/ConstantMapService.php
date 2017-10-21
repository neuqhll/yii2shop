<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2017/9/14
 * Time: 21:45
 */

namespace app\common\services;


class ConstantMapService
{
    public static $status_default = '-1';
    public static $status_mapping = [
        1 => '正常',
        0 => '删除',
    ];
    public static $default_avatar="default_avatar";
    public static $default_pwd = "******";
    public static $default_time_stamps = '1971-01-01 00:00:00';
    public static $default_syserror = '系统繁忙，请稍后再试~~';
    public static $sex_mapping = [
        1 => '男',
        2 => '女',
        0 => '未填写'
    ];

    public static $pay_status_mapping = [
        1 => '已支付',
        -8 => '待支付',
        0 => '已关闭'
    ];

    public static $express_status_mapping = [
        1 => '会员已签收',
        -6 => '已发货待签收',
        -7 => '已付款待发货',
        -8 => '待支付',
        0 => '已关闭'
    ];

    public static $express_status_mapping_for_member = [
        1  => '已签收',
        -6 => '已发货',
        -7 => '等待商家发货',
        -8 => '待支付',
        0 => '已关闭'
    ];
}