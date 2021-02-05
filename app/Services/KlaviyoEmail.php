<?php 
namespace App\Services;

use App\Eloquent\Tradein;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

class KlaviyoEmail{

    private $klaviyokey;
    private $userkey;
    private $client;

    public function __construct()
    {
        $this->klaviyokey = env('KLAVIYO_API_KEY');
        $this->userkey = env('KLAVIYO_USER_KEY');
        $this->client = new Klaviyo( $this->klaviyokey, $this->userkey);
    }

    //done
    public function AccountCreated($user){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Creation of account',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$first_name' => $user->first_name,
                    '$last_name' => $user->last_name,
                    '$birthdate' => $user->birthdate,
                    '$newsletter' => $user->sub,
                ),
                'properties' => array(
                    'User Registered' => true
                )
            )
        );

        $this->sendEmail($event);
    }
  
    //done
    public function ItemSoldPrintOwnLabel($user, Tradein $tradein){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Item Sold to Bamboo (Print own label)',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                    '$tradein_id' => $tradein->barcode_original,
                    '$proposed_price' => $tradein->order_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //done
    public function ItemSoldTradePack($user, Tradein $tradein){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Item Sold to Bamboo (Tradepack)',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                    '$tradein_id' => $tradein->barcode_original,
                    '$proposed_price' => $tradein->order_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //done
    public function TradePackSent($user, Tradein $tradein){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Trade pack sent',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                    '$tradein_id' => $tradein->barcode_original,
                    '$proposed_price' => $tradein->order_price,
                ),
                'properties' => array(
                    'Trade pack sent' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    public function offerRemainder($user){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer Remainder',
                'customer_properties' => array(
                    '$email' => $user->email,
                ),
                'properties' => array(
                    'Offer Remainder' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Done
    public function receiptOfDevice($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Receipt of device',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Receipt of device' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //done
    public function noImei($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'No IMEI',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'No IMEI' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Done
    public function missingDevice($user){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Missing Device',
                'customer_properties' => array(
                    '$email' => $user->email,
                ),
                'properties' => array(
                    'Missing Device' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Impossible to do atm */

    public function cancellationNoReturn($user){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Cancellation (No device return)',
                'customer_properties' => array(
                    '$email' => $user->email,
                ),
                'properties' => array(
                    'Cancellation (No device return)' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Impossible to do atm */

    public function cancellationWithReturn($user){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Cancellation (Device return)',
                'customer_properties' => array(
                    '$email' => $user->email,
                ),
                'properties' => array(
                    'Cancellation (Device return)' => true
                )
            )
        );

        $this->sendEmail($event);
    }


    /* Done */
    public function pinLocked($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Pin Locked',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Pin Locked' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function googleLocked($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Google Locked',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Google Locked' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Email missing */
    public function FIMP($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'FIMP',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'FIMP' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function wrongDevice($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Wrong Device',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$deviceWrong' => $tradein->getProductName($tradein->product_id),
                    '$deviceRight' => $tradein->getProductName($tradein->correct_product_id),
                    '$newPrice' => $tradein->bamboo_price,
                ),
                'properties' => array(
                    'Wrong Device' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function downgraded($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Downgraded',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$customerGrade' => $tradein->customer_grade,
                    '$bambooGrade' => $tradein->bamboo_grade,
                    '$newPrice' => $tradein->bamboo_price,
                ),
                'properties' => array(
                    'Downgraded' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function lockedNetwork($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Locked Network',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$originalNetwork' => $tradein->customer_network,
                    '$bambooNetwork' => $tradein->correct_network,
                    '$newPrice' => $tradein->bamboo_price,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Locked Network' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function devicePassedTest($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Passed Test',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                    '$price' => $tradein->bamboo_price,
                ),
                'properties' => array(
                    'Passed Test' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function blacklisted($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Blacklisted',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Blacklisted' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function deviceStolen($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Device Stolen',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Device Stolen' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /* Done */
    public function deviceUnderContract($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Device Under Contract',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                    '$originalNetwork' => $tradein->customer_network,
                ),
                'properties' => array(
                    'Device Under Contract' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    public function deviceReturn($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Device Return',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Device Return' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    public function paymentUnsuccesful($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Payment Unsuccessful',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Payment Unsuccessful' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    public function paymentSuccesful($user, Tradein $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Payment Successful',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$device' => $tradein->getProductName($tradein->product_id),
                ),
                'properties' => array(
                    'Payment Successful' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    public function sendEmail($event){
        $this->client->publicAPI->track( $event );  
    }
}


?>