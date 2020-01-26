<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $driver = 'digist_id';
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
            //login
            Auth::login($user);
            //redirect
            return redirect('/');
        }catch (\Exception  $exception) {
//            die($exception->getMessage());
        }
        return redirect(route('auth.login'))->with(['auth.error' => 'Autentikasi gagal.']);
    }


}
