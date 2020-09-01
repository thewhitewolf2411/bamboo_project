<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Crypt;
use Str;

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
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $user = "";

        if(Str::contains($request->username, "@")){
            $user      = User::where('email', $request->input('username'))->first();
        }
        else{
            $user      = User::where('username', $request->input('username'))->first();
        }

        $decrypted = $request->password; 

        if ($user) {
            if (Crypt::decrypt($user->password) == $decrypted) {
                Auth::login($user);

                return $this->sendLoginResponse($request);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = "/";
    public function redirectTo(){
        // User role
        $role = Auth::user()->type_of_user; 
        // Check user role
        switch ($role) {
            case 0:
                return '/userprofile';
                break;
            case 1:
                return '/portal';
                break; 
            case 2:
                return '/portal';
                break; 
            case 3:
                return '/portal';
                break; 
            default:
                return '/userprofile'; 
                break;
            }
    }

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('login');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }
}
