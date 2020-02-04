<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 26/01/2020
 * Time: 9:53
 */

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Api\ApiApp;
use App\Http\Controllers\Api\ApiResponse;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class ApiAuth extends ApiApp
{
    use ApiResponse;

    /**
     * ApiAuth constructor.
     */
    public function __construct()
    {

    }

    public function login(Request $request){
        $email = $request->post('email');
        $password = $request->post('password');
        /**
         * Validations
         */
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if($validation->fails()){
            $this->reply['message'] = $validation->errors();
            return response($this->reply, 400);
        }

        /**
         * Cek login to Identity Server via password token
         */
        $http = new \GuzzleHttp\Client;
        $requestToken = $http->post(config('app.laravelpassport_host').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('app.laravelpassport_password_key'),
                'client_secret' => config('app.laravelpassport_password_secret'),
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ],
        ]);

        if($requestToken->getStatusCode() !== 200){
            $this->reply['message'] = $requestToken->getBody()->getContents();
            return response($this->reply, 400);
        }
        /**
         * GET USER INFO
         */
        $responseBody = json_decode($requestToken->getBody(), true);

        $requestUser = $http->request('GET', config('app.laravelpassport_host').'/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$responseBody['access_token'],
            ],
        ]);
        $responseUser = json_decode($requestUser->getBody(), true);
        /**
         * Login and response token
         */
        $user = User::updateOrCreate(
            ['email' => $email, 'driver' => 'DIGIST_ID'],
            [
                'name' => $responseUser['name'],
                'username' => $responseUser['username'],
                'photo' => $responseUser['photo'],
            ]
        );
        //login
        Auth::login($user);
        $this->reply['status'] = true;
        $this->reply['data'] =$responseBody;
        return response($this->reply);
    }
}
