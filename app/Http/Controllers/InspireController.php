<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

header("Content-Type:text/html;charset=gb2312");
class InspireController extends Controller
{
    public function getLog(Request $request){

        if (!empty($request->get('date'))){
            $time = $request->get('date');
        }else{
            $time = date('Y-m-d', time());
        }

        $file_path = storage_path('logs/laravel-'  . $time . '.log');

        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
            $str = "";
            $buffer = 1024;//每次读取 1024 字节
            while(!feof($fp)){//循环读取，直至读取完整个文件
                $str .= fread($fp,$buffer);
            }
            $str = str_replace("\r\n","<br />",$str);
            echo $str;
        }else{
            echo '<h1 align="center" backcolor="black">日志不存在，请检查参数！</h1>';
        }
    }

    private function getLogType($type){
        return $type . 'Log/';
    }

    public function getLogs(Request $request, $type){
        if (!empty($request->get('date'))){
            $time = $request->get('date');
        }else{
            $time = date('Ymd', time());
        }

        $logType = $this->getLogType($type);

        if ($request->get('ext')){
            $logName = $request->get('ext');
        }else{
            $logName = $type;
        }

        $file_path = storage_path('logs/logRecord/' . $logType . $logName . '-' . $time);

        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
            $str = "";
            $buffer = 1024;//每次读取 1024 字节
            while(!feof($fp)){//循环读取，直至读取完整个文件
                $str .= fread($fp,$buffer);
            }
            $str = str_replace("\r\n","<br />",$str);
            echo $str;
        }else{
            echo '<h1 align="center" backcolor="black">日志不存在，请检查参数！</h1>';
        }
    }

}
