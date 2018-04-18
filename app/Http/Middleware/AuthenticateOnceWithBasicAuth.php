<?php

namespace App\Http\Middleware;

use App\Config\Config;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (
            isset($_SERVER['PHP_AUTH_USER']) &&
            $_SERVER['PHP_AUTH_USER'] == Config::API_USER &&
            $_SERVER['PHP_AUTH_PW'] == Config::API_PW){
            return $next($request);
        }

        $ret = Auth::onceBasic();

        return $ret;
    }

}