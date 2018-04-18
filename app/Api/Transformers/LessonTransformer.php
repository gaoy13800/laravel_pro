<?php
/**
 * Created by PhpStorm.
 * User: don
 * Date: 17-6-6
 * Time: 下午6:22
 */

namespace App\Api\Transformers;
class LessonTransformer extends Transformer
{

    static $lesson = [
        'name|string' => 'title',
        'content|string' => 'body',
        'id' => 'id'
    ];

    static $moreLesson = [
        'summary' => 'title',
        'more' => 'body',
        'createTime' => 'created_at'
    ];

    static $lesson2 = [
        'schoolId' => 'id',
        'schoolTitle|int' => 'title',
        'schoolContent|string' => 'body',
        'createTime' => 'created_at'
    ];

}