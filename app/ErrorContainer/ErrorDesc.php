<?php
/**
 * Created by PhpStorm.
 * User: s
 * Date: 17/6/15
 * Time: 下午4:44
 */

namespace App\ErrorContainer;


abstract class ErrorDesc
{
    static $_describe = [

        ErrorCode::UNKNOWN_FAILED_TYPE=> '未知错误类型',
       
    ];
}