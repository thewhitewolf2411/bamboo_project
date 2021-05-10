<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Http\Request;
use App\Services\KlaviyoEmail;
use App\Services\NotificationService;
use Carbon\Carbon;
use Crypt;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

    }

    /**
     * Check if birth date is valid.
     */
    protected function checkBirthDate($data){
        if(isset($data['birth_day']) && isset($data['birth_month']) && isset($data['birth_year'])){
            try{
                $date = Carbon::parse($data['birth_day'].'.'.$data['birth_month'].'.'.$data['birth_year']);
                return true;
            } catch(Exception $e){
                return false;
            }
        }
        return true;
    }

    public function register(Request $request)
    {
        dd($request->all());
        if(!$this->checkBirthDate($request->all())){
            return redirect('/')->with('regerror','Invalid birth date');
        }
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('/')->with('regerror','This email is already registered');
        }

        $user = $this->create($request->all());
        $this->guard()->login($user);
        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $sub = 0;
        if($data['sub'] === 'true'){
            $sub = true;
        }

        $user = new User();

        $user->first_name = $data['first-name'];
        $user->last_name = $data['last-name'];
        $user->email = $data['email'];
        $user->password = Crypt::encrypt($data['password']);
        if(isset($data['birth_day']) && isset($data['birth_month']) && isset($data['birth_year'])){
            $user->birth_date = Carbon::parse($data['birth_day'].'.'.$data['birth_month'].'.'.$data['birth_year']);
        }
        
        $user->delivery_address = $data['delivery_address'];
        $user->billing_address = $data['billing_address'];
        $user->contact_number = $data['contact_number'];

        if(isset($data['preferred-os'])){
            $user->preffered_os = $data['preferred-os'];
        }
        else{
            $user->preffered_os = null;
        }
        if(isset($data['current-phone'])){
            $user->current_phone = $data['current-phone'];
        }
        else{
            $user->current_phone = null;
        }
        $user->sub = $sub;

        $user->save();

        $klaviyoEmail = new KlaviyoEmail();
        $klaviyoEmail->AccountCreated($user);

        // send notification (register)
        if($user->sub){
            $notificationService = new NotificationService();
            $notificationService->send($user, 1);
        }
        return $user;
    }
}
