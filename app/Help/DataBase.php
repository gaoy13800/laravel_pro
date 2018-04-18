<?php
/**
 * Created by PhpStorm.
 * User: Gaoy
 * Date: 2017/11/14
 * Time: 15:36
 */

namespace App\Help;


class DataBase
{

    public static function supplementLike($likeString){

        return '%' . $likeString . '%';

    }


}