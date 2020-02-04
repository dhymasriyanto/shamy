<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\TokenInfo;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function auliaIdRedirect(Request $request){
        return Socialite::with('laravelpassport')->redirect();
    }

    public function callback(Request $request){
        $driver = 'DIGIST_ID';
        $message = '';
        try {
            $oauthUser = Socialite::driver('laravelpassport')->user();
            $userAccount = $oauthUser->user;
            $user = User::updateOrCreate(
                ['email' => $userAccount['email'], 'driver' => $driver],
                [
                    'name' => $userAccount['name'],
                    'username' => $userAccount['username'],
                    'photo' => $userAccount['photo'],
                ]
            );
            //Save user information
            $accessTokenBody = $oauthUser->accessTokenResponseBody;
            $token = new TokenInfo();
            $token->user_id = $user->id;
            $token->token_type = $accessTokenBody['token_type'];
            $token->expires_in = $accessTokenBody['expires_in'];
            $token->access_token = $accessTokenBody['access_token'];
            $token->refresh_token = $accessTokenBody['refresh_token'];
            $token->user_agent = $request->userAgent();
            $token->ip = $request->ip();
            if(!$token->save()){
                $message = 'Cannot save data. Please contact your administrator';
            }
            //login and redirect
            Auth::login($user);
        }catch (\Exception  $exception) {
            $message = $exception->getMessage();
        }
        return redirect(route('auth.login'))->with(['auth.error' => 'Autentikasi gagal. '.$message]);
    }


}
