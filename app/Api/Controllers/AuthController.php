<?php
/**
 * Created by PhpStorm.
 * User: don
 * Date: 17-6-6
 * Time: 下午6:38
 */

namespace App\Api\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends BaseController{

    /**login   登陆 返回jwt token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('userName', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**注册
     * 返回token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $rules = [
            'email' => ['required','email'],
            'password' => ['required', 'min:6'],
            'name' => ['required']
        ];

        $payload = $request->only('name', 'email', 'password');
        $validator = Validator::make($payload, $rules);

        if ($validator->fails()){
            return $this->response->array(['error' => $validator->errors()]);
        }

        $newUser = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password'))
        ];

        try{
            $user = User::create($newUser);
            $token = JWTAuth::fromUser($user);
        }catch (\PDOException $exception){
            return $this->response->array(['error' => $exception->getMessage()]);
        }
        return response()->json(compact('token'));
    }

}
