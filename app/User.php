<?php

namespace App;

use App\Eloquent\Payment\UserBankDetails;
use App\Eloquent\SellingProduct;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use App\Notification\CustomPasswordReset;
use Illuminate\Support\Facades\Request;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;
use App\Services\KlaviyoEmail;

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
        'username','worker_email','birth_date'
    ];

    public function fullName(){
        if($this->first_name === $this->last_name){
            return $this->first_name;
        }
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

    public function billingAddress(){
        return $this->billing_address;
    }

    public function shippingAddress(){
        $formatted = explode(",", $this->delivery_address);
        if(isset($formatted[count($formatted) - 1])){
            unset($formatted[count($formatted) - 1]);
        }
        return implode(", ", $formatted);
    }

    public function collectionAddress(){
        return "<br>" . $this->delivery_address;
    }

    public function postCode(){
        $postcode = explode(",", $this->delivery_address);
        if(isset($postcode[count($postcode) - 1])){
            return $postcode[count($postcode) - 1];
        }
    }

    public function getCurrentPhone(){
        $phone = SellingProduct::find($this->current_phone);
        if($phone){
            return $phone->product_name;
        }
        return null;
    }

    public function profileDeliveryAddress(){
        return str_replace(',', '<br>', $this->delivery_address);
    }

    public function profileBillingAddress(){
        return str_replace(',', '<br>', $this->billing_address);
    }

    public function getBirthDate(){
        return Carbon::parse($this->birth_date)->format('d/m/y');
    }

    public function getBirthDay(){
        $exploded = explode('.', $this->birth_date);
        return $exploded[0];
    }

    public function getBirthMonth(){
        $exploded = explode('.', $this->birth_date);
        return $exploded[1];
    }

    public function getBirthYear(){
        $exploded = explode('.', $this->birth_date);
        return $exploded[2];
    }

    public function sendPasswordResetNotification($token)
    {

        $klaviyoEmail = new KlaviyoEmail();
        $klaviyoEmail->sendPasswordResetNotification($token);

    }
}
