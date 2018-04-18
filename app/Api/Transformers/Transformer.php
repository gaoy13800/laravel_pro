<?php
/**
 * Created by PhpStorm.
 * User: s
 * Date: 17/6/16
 * Time: 上午10:18
 */

namespace App\Api\Transformers;

use App\Models\RepairMan;
use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{

    const INT = 1;

    const STRING = 2;

    const BOOL = 3;

    const JSON = 4;

    const FLOAT = 5;

    const TIMESTAMP = 6;



    protected $curField;

    /**
     * LessonTransformer constructor.
     * @param $curField
     */
    public function __construct($curField = '')
    {
        $this->curField = $curField;
    }


    public function transform($data, $transField, $transSingle){

        if ($transSingle){
            return $this->instance($transField, $data);
        }else{
            return  $data->map(function ($single)use($transField){
                return $this->instance($transField, $single);
            })->all();
        }
    }



    private function instance($rule ,$seed){
        $instance = [];

        foreach ($rule as $index => $modelIndex){

            $scope = $this->look_handle_scope(collect(explode('|', $index))->last());

            $instance[collect(explode('|', $index))->first()] = $this->handle_value($scope, $seed[$modelIndex]);
        }

        return $instance;
    }

    private function look_handle_scope($scope){
        return collect([
            'int' => 1,
            'string' => 2,
            'bool' => 3,
            'json' => 4,
            'float' => 5,
            'timestamp' => 6
        ])->get($scope, false);
    }

    private function handle_value($scope, $value){

        switch ($scope){
            case self::INT :
                $value = (int)$value;
                break;
            case self::STRING :
                $value = (string)$value;
                break;
            case self::BOOL:
                $value = (boolean)$value;
                break;
            case self::JSON:
                $value = (array)json_decode($value, true);
                break;
            case self::FLOAT :
                $value = (float)$value;
                break;
            case self::TIMESTAMP :
                $value = strtotime($value);
                break;
            default:
                break;
        }

        return $value;
    }

}