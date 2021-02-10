<?php

namespace App;

use App\Eloquent\Payment\UserBankDetails;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email','password','current_phone','preffered_os','sub','delivery_address','billing_address','contact_number','bamboo_credit',
        'username','worker_email'
    ];

    public function fullName(){
        return $this->first_name . " " . $this->last_name;
    }

    public function superAdmin(){
        if($this->type_of_user === 3){
            return true;
        }
        return false;
    }

    public function canDeleteNotes(){
        if($this->type_of_user === 3){
            return "true";
        }
        return "false";
    }

    public function admin(){
        if($this->type_of_user > 1){
            return true;
        }
        return false;
    }

    public function hasPaymentDetails(){
        $bank_details = UserBankDetails::where('user_id', $this->id)->get();
        if($bank_details->isEmpty()){
            return false;
        }
        return true;
    }

    public function accountName(){
        $bank_details = UserBankDetails::where('user_id', $this->id)->first();
        try {
            return Crypt::decrypt($bank_details->account_name);
        } catch (DecryptException $e) {
            dd($e);
        }
    }

    public function accountNumber(){
        $bank_details = UserBankDetails::where('user_id', $this->id)->first();
        try {
            $decrypted = Crypt::decrypt($bank_details->card_number);
            return '****' . substr($decrypted, 4);
        } catch (DecryptException $e) {
            dd($e);
        }
    }

    public function sortCode(){
        $bank_details = UserBankDetails::where('user_id', $this->id)->first();
        try {
            $decrypted = Crypt::decrypt($bank_details->sort_code);
            return '***' . substr($decrypted, 3);
        } catch (DecryptException $e) {
            dd($e);
        }
    }
}
