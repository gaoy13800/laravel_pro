<?php
/**
 * Created by PhpStorm.
 * User: don
 * Date: 17/4/6
 * Time: 上午11:32
 */

namespace App\Help;

use App\Config\Config;
use App\Models\File;
date_default_timezone_set('Asia/Shanghai');
class Help {


    /**发送短信验证码
     * @param $mobile
     * @param $content
     * @return mixed
     */
    public static function sendSmsCode($mobile, $content){


        $sms = new SMS();

        $result = $sms->sendSMS($mobile,$content);
        //$result = $shuodaSdk->overAge();
        //$result = $shuodaSdk->checkKeyWord('诈骗');
        //$result = $shuodaSdk->queryStatus();
        //$result = $shuodaSdk->call();
       return $sms->execResult($result);
    }


    /**生成验证码
     * @return string
     */
    public static function getCheckCode(){
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code = $code . substr(str_shuffle('0123456789'), 0, 1);
        }
        return $code;
    }

    /**生成随机密码
     * @param int $length
     * @return string
     */
    public static function getUserPassWd($length = 6) {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }

        return $password;
    }

    public static function getOrderNumber(){
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn = $yCode[intval(date('Y')) - 2011] .
            date('YmdHis',time()).rand(100000,999999);
        return $orderSn;
    }

    /**二维数组排序
     * @param $param
     * @param $field
     * @param bool $order
     * @return bool
     */
    public static function sort_by_field(&$param, $field, $order = true){
        uasort($param, function ($x, $y)use($field, $order){
            return strcasecmp($x[$field],$y[$field]);
        });

        if (!$order){
            $param = array_reverse($param);
            return true;
        }
    }



    /**
     * 对象转数组
     * @param $array
     * @return array
     */
    public static function  object2Array($array) {
        if (is_object($array)) {
            $array = (array)$array;
        }

        if (is_array($array)) {
            $newArray = array();
            foreach ($array as $key => $value) {
                $newArray[$key] = self::object2Array($value);
            }
            return $newArray;
        }

        return $array;
    }


    /**
     * 压缩图片
     * @param $path
     * @return bool
     */
    public static function updateImage($img_src, $new_img_path){

        $img_info = @getimagesize($img_src);
        $new_width = $img_info[0] >  350 ? 350 : $img_info[0];
        $new_height = $img_info[1] > 250 ? 250 : $img_info[1];
        if (!$img_info || $new_width < 1 || $new_height < 1 || empty($new_img_path)) {
            return false;
        }
        if (strpos($img_info['mime'], 'jpeg') !== false) {
            $pic_obj = imagecreatefromjpeg($img_src);
        } else if (strpos($img_info['mime'], 'gif') !== false) {
            $pic_obj = imagecreatefromgif($img_src);
        } else if (strpos($img_info['mime'], 'png') !== false) {
            $pic_obj = imagecreatefrompng($img_src);
        } else {
            return false;
        }
        $pic_width = imagesx($pic_obj);
        $pic_height = imagesy($pic_obj);
        if (function_exists("imagecopyresampled")) {
            $new_img = imagecreatetruecolor($new_width,$new_height);
            imagecopyresampled($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
        } else {
            $new_img = imagecreate($new_width, $new_height);
            imagecopyresized($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
        }
        if (preg_match('~.([^.]+)$~', $new_img_path, $match)) {
            $new_type = strtolower($match[1]);
            switch ($new_type) {
                case 'jpg':
                    imagejpeg($new_img, $new_img_path);
                    break;
                case 'gif':
                    imagegif($new_img, $new_img_path);
                    break;
                case 'png':
                    imagepng($new_img, $new_img_path);
                    break;
                default:
                    imagepng($new_img, $new_img_path);
            }
        } else {
            imagejpeg($new_img, $new_img_path);
        }
        imagedestroy($pic_obj);
        imagedestroy($new_img);
        $new_size = filesize($new_img_path);
        return $new_size;
    }

    /** 数组转xml
     * @param $arr
     * @return string
     */
    public static function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
            if(is_array($val)){
                $xml.="<".$key.">".arrayToXml($val)."</".$key.">";
            }else{
                $xml.="<".$key.">".$val."</".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    /** xml转数组
     * @param $xml
     * @return mixed
     */
    public static function xmlToArray($xml){
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlString = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $arr = json_decode(json_encode($xmlString),true);
        return $arr;
    }

    /**格式化时间戳
     * @param string $time
     * @return false|string
     */
    public static function CurrentTime($time = ''){
        if (empty($time)){
            return date('Y-m-d H:i:s', time());
        }else {
            return date('Y-m-d H:i:s', $time);
        }
    }

    /**格式化未知格式数据
     * @param $data
     * @return mixed
     */
    public static function toFormatData($data){
        return json_decode(json_encode($data), 1);
    }

    public static function string2UTF8($data){
        if(!empty($data) ){
            $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
            if($fileType != 'UTF-8'){
                $data = mb_convert_encoding($data ,'utf-8' , $fileType);
            }
        }
        return $data;
    }

    public static function getMinNum($startTime,$endTime){
        $secs = $endTime - $startTime;
        $min = ceil($secs%86400/60) + 1440 * floor($secs/86400);
        return $min;
    }
}