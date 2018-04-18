<?php
namespace App\Api\Controllers\V1;


use App\Api\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

header("Content-Type: text/html; charset=utf-8");
class TestController extends BaseController{


    const Wt_Single_Charge_Record = 'wt:parking:single:normal:record:';//<车牌号>
    const Wt_Single_Charge_NotPass = 'wt:parking:not:pass:';//<车牌号>
    const Wt_Allow_License_Record = 'wt:parking:single:heart:allow:';//wt:parking:single:allow:<deviceId>     <license>


    public function index_test(Request $request){

        $redis = app('redis');

        $ret = $redis->hgetall(self::Wt_Single_Charge_Record . $request->get('license'));

        dd($ret);


    }


    /**
     * @param Request $request
     */
    public function index(Request $request){


//        $rawContent = file_get_contents("php://input");

//        $this->analysisData();
//
//        Log::info($rawContent);exit;



        $ret = $this->test();

        if (!empty($ret)){
            return response()->json($ret);
        }



//        return 1;

//        Log::info("test" . json_encode($GLOBALS));
    }


    public function analysisData(){
        $rawContent = file_get_contents("php://input");

        if (!empty($rawContent)){
            $content = json_decode($rawContent, true);
        }

        $result = isset($content['AlarmInfoPlate']) ? $content['AlarmInfoPlate'] : '';

        Log::info(\GuzzleHttp\json_encode($result));
    }

    public function test(){
        $rawContent = file_get_contents("php://input");

        Log::info($rawContent);

        $rawContent = $this->characet($rawContent);

        if (empty($rawContent)) {
            return false;
        }

        $json = json_decode($rawContent);

        if ($json == null){
            $request = array();
            parse_str($rawContent, $request);
            $json = json_decode(json_encode($request));
        }


        if (isset($json->KeepAlive)){
            Log::error('heart' . json_encode($json->KeepAlive));
            return false;
        }

        if (isset($json->AlarmInfoPlate)){
            Log::error('shibie' . json_encode($json->AlarmInfoPlate));
        }


        $result = [
            'Response' => [
                "Open" => 1,
                "SerialData" => [
                    "data" => "",
                    "datalen" => "0"
                ]
            ]
        ];

        return $result;


        /**
         *  "Response":{

        "Open":0,        //1 开闸  0 不开闸（数字）

        "SerialData":{   //串口透传数据

        "data":"....",    //base64 加密

        "datalen":123     //数据长度（数字）

        }

        }

         */

        return 1;
    }

    public function keepAliveReceive(){

    }

    private function getStreamContent(){
        $rawContent = file_get_contents("php://input");

        if (!empty($rawContent)){
            return json_decode($rawContent);
        } else {
            return '';
        }
    }


    private function getContents($param){

        $result = [
            'type' => '',
            'content' => []
        ];

        if (isset($param['KeepAlive'])){
            $result['type'] = 'KeepAlive';
        } else {
            $result['type'] = 'Discern';
        }

        $result['content'] = $param;
    }


    function is_json($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    function characet($data){
        if(!empty($data) ){
            $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
	    if($fileType != 'UTF-8'){
            $data = mb_convert_encoding($data ,'utf-8' , $fileType);
	    }
	  }
	  return $data;
	}
}