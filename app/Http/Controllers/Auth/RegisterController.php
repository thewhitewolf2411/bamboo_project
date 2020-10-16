<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

use Crypt;

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
        //validation deleted
        return Validator::make($data, [

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        /*$client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
        $event = new KlaviyoEvent(
            array(
                'event' => 'Filled out Profile',
                'customer_properties' => array(
                    '$email' => 'someone@mailinator.com'    
                ),
                'properties' => array(
                    'Added Social Accounts' => False
                )
            )
        );
        dd($client);*/

        $sub = 0;
        if($data['sub'] == true){
            $sub = 1;
        }

        $user = new User();

        $user->first_name = $data['first-name'];
        $user->last_name = $data['last-name'];
        $user->email = $data['email'];
        $user->birthdate = $data['birthdate'];
        $user->password = Crypt::encrypt($data['password']);
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
        $user->sub = 1;

        $user->save();

        return $user;
    }
}
