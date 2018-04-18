<?php
/**
 * Created by PhpStorm.
 * User: don
 * Date: 17-6-6
 * Time: 下午6:17
 */

namespace App\Api\Controllers;


use App\Config\Config;
use App\ErrorContainer\ErrorCode;
use App\ErrorContainer\ErrorDesc;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller{

    use Helpers;

    protected $statusCode;

    protected $transformerPlace;

    protected $validateFails;

    protected $responseData = [
        'errorCode' => 0,
        'errorMsg' => 'ok'
    ];

    protected function setTransform($trans){

        if (!is_array($trans)){
            $this->transformerPlace = $trans;
        }else{
            collect($trans)->map(function ($tran){
                $this->transformerPlace[] = $tran;
            });
        }

    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode ? $this->statusCode : 200;
    }


    /**
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function dataBuild($data, $lookup, $transSingle = false){

        if (!is_array($this->transformerPlace)){
            return $this->transformerPlace->transform($data, $lookup, $transSingle);
        }else{
            //todo
        }


    }

    /**
     * @param $errorCode
     * @param string $customizedDesc
     * @return mixed
     */
    protected function setErrorInfo($errorCode, $customizedDesc = ''){

        if (array_key_exists($errorCode, ErrorDesc::$_describe)) {

            $this->responseData = [
                'errorCode' => $errorCode,
                'errorMsg' => ErrorDesc::$_describe[$errorCode]
            ];

        } else if ($errorCode == -100){
            $this->responseData = [
                'errorCode' => '-100',
                'errorMsg' => $customizedDesc
            ];
        }else {

            $this->responseData = [
                'errorCode' => '-1',
                'errorMsg' => ErrorDesc::$_describe[ErrorCode::UNKNOWN_FAILED_TYPE]
            ];
        }
        return $this->response->array($this->responseData)->setStatusCode($this->getStatusCode());
    }

    /**
     * @param string $data
     * @return mixed
     */
    protected function output($data = ''){

        if (!empty($data) | $data == []){
            $this->responseData['data'] = isset($data->original) ? $data->original : $data;
        }
        return $this->response->array($this->responseData);
    }

    protected static function enableCustomizedLog($prefix = 'any'){
        \Log::useFiles(storage_path(Config::LOG_PATH['base_path']) . $prefix .'-' . date('Ymd', time()));
    }


    protected function validateRule($rules, $payload){
        $validator = Validator::make($payload, $rules);

        if ($validator->fails()){
            $this->validateFails = $validator->errors();

            return false;
        }

        return true;
    }

    protected function getAgentUrlByAgentId($agentId){

        $redis = app('redis');
        $url = $redis->hget('wt:agent:tbase:urls', $agentId);
        if (!empty($url)){
            return $url;
        }
        return Config::Tbase_url;
    }
}