<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;

class CheckWap
{
    const errorResponse = [
        0x00220 => 'token未注册',
        0x00221 => 'token验证失败'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $wap_token = $request->header('wap_token');

        if (empty($wap_token)){
             return response()->json($this->returnContent('not register'));
        } elseif (!$this->validateToken($wap_token)){
            return response()->json($this->returnContent('token invalid'));
        }

        return $next($request);
    }


    private function returnContent($errorDesc){

        if ($errorDesc == 'not register'){
            $errorCode = 0x00220;
        }elseif ($errorDesc == 'token invalid'){
            $errorCode = 0x00221;
        }

        return  [
            'errorCode' => $errorCode,
            'errorMsg' => self::errorResponse[$errorCode]
        ];
    }

    private function validateToken($token){
         $token = Member::where('token', $token)->first();

         if (empty($token)){
             return false;
         }

         return true;
    }
}
