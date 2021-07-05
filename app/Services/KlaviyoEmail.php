<?php 
namespace App\Services;

use App\Eloquent\Tradein;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

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

    /**
     * Group OrderTypes - SignUp Email Start
     */

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

    public function sendPasswordResetNotification($token)
    {
        $url = '/password/reset/'. $token;
        $event = new KlaviyoEvent(

            array(
                'event'=>'Reset Password',
                'customer_properties'=>array(
                  '$email'=>$_REQUEST['email'],
                  '$PasswordResetLink'=>$_SERVER['SERVER_NAME'] . $url,
                ),
                'properties'=>array(
                  'event_id'=>'1234',
                  'PasswordResetLink'=>$_SERVER['SERVER_NAME'] . $url,
                ),
                'time'=>\Carbon\Carbon::now()
            )
        );

        $this->sendEmail($event);

    }

    public function sendAbandonedBasketEmail($user, $product){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Abandoned Basket',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$first_name' => $user->first_name,
                    '$abandoned_card_device_1' => $product->product_name,
                    '$abandoned_card_device_1_price' => $product->getExcellentWorkingPrice(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /**
     * Group OrderTypes - SignUp Email End
     */
  
    /*
    * Print Your Own - Customer Inbound Start Emailing
    */
    //Offer EM - 1  __One Device__
    public function oneItemSoldPrintOwnLabel($user, $tradein){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 1',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_1_device_1' => $tradein->getCustomerProductName(),
                    '$em_1_tradein_id_1' => $tradein->barcode_original,
                    '$em_1_proposed_price_1' => $tradein->order_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 1  __Two Devices__
    public function twoItemSoldPrintOwnLabel($user, $cart){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 1',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_1_device_1' => $cart[0]->getCustomerProductName(),
                    '$em_1_tradein_id_1' => $cart[0]->barcode_original,
                    '$em_1_proposed_price_1' => $cart[0]->order_price,
                    '$em_1_device_2' => $cart[1]->getCustomerProductName(),
                    '$em_1_tradein_id_2' => $cart[1]->barcode_original,
                    '$em_1_proposed_price_2' => $cart[1]->order_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 2
    public function orderExpiresInSevenDays($user, $tradeins){
        if(count($tradeins) === 1){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 2',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_2_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_2_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_2_proposed_price_1' => '£' . $tradeins[0]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }
        if(count($tradeins) === 2){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 2',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_2_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_2_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_2_proposed_price_1' => '£' . $tradeins[0]->order_price,
                        '$em_2_device_2' => $tradeins[1]->getCustomerProductName(),
                        '$em_2_tradein_id_2' => $tradeins[1]->barcode_original,
                        '$em_2_proposed_price_2' => '£' . $tradeins[1]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }

        $this->sendEmail($event);
    }

    //Offer EM - 3
    public function orderExpiresInFourDays($user, $tradeins){
        if(count($tradeins) === 1){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 3',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_3_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_3_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_3_proposed_price_1' => '£' . $tradeins[0]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }
        if(count($tradeins) === 2){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 3',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_3_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_3_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_3_proposed_price_1' => '£' . $tradeins[0]->order_price,
                        '$em_3_device_2' => $tradeins[1]->getCustomerProductName(),
                        '$em_3_tradein_id_2' => $tradeins[1]->barcode_original,
                        '$em_3_proposed_price_2' => '£' . $tradeins[1]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }

        $this->sendEmail($event);
    }

    //Offer EM - 12
    public function orderExpired($user, $tradeins){
        if(count($tradeins) === 1){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 12',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_12_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_12_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_12_proposed_price_1' => '£' . $tradeins[0]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }
        if(count($tradeins) === 2){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 3',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_12_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_12_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_12_proposed_price_1' => '£' . $tradeins[0]->order_price,
                        '$em_12_device_2' => $tradeins[1]->getCustomerProductName(),
                        '$em_12_tradein_id_2' => $tradeins[1]->barcode_original,
                        '$em_12_proposed_price_2' => '£' . $tradeins[1]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }

        $this->sendEmail($event);
    }

    //Offer EM - 13
    public function orderNeverReceived($user, $tradeins){
        if(count($tradeins) === 1){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 13',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_13_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_13_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_13_proposed_price_1' => '£' . $tradeins[0]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }
        if(count($tradeins) === 2){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 13',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_13_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_13_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_13_proposed_price_1' => '£' . $tradeins[0]->order_price,
                        '$em_13_device_2' => $tradeins[1]->getCustomerProductName(),
                        '$em_13_tradein_id_2' => $tradeins[1]->barcode_original,
                        '$em_13_proposed_price_2' => '£' . $tradeins[1]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }

        $this->sendEmail($event);
    }

    /*
     *   Print Your Own - Customer Inbound End Emailing
     */


    /*
     *  Customer Converts to Free Trade Pack Start Emailing  
     */
    //Offer EM - 4
    public function tradePackSent($user, $tradeins){
        if(count($tradeins) === 1){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 4',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_4_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_4_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_4_proposed_price_1' => '£' . $tradeins[0]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }
        if(count($tradeins) === 2){
            $event = new KlaviyoEvent(
                array(
                    'event' => 'Offer EM - 4',
                    'customer_properties' => array(
                        '$email' => $user->email,
                        '$em_4_device_1' => $tradeins[0]->getCustomerProductName(),
                        '$em_4_tradein_id_1' => $tradeins[0]->barcode_original,
                        '$em_4_proposed_price_1' => '£' . $tradeins[0]->order_price,
                        '$em_4_device_2' => $tradeins[1]->getCustomerProductName(),
                        '$em_4_tradein_id_2' => $tradeins[1]->barcode_original,
                        '$em_4_proposed_price_2' => '£' . $tradeins[1]->order_price,
                    ),
                    'properties' => array(
                        'Item sold' => true
                    )
                )
            );
        }

        $this->sendEmail($event);
    }

    /*
    *   Customer Converts to Free Trade Pack End Emailing
    */

    /* 
    *   Group Order Types - Print your Own Trade Pack / Free Trade Pack - Device Receipt Email Start
    */
    //Offer EM - 7
    public function deviceReceived($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 7',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_7_device_1' => $tradein->getCustomerProductName(),
                    '$em_7_proposed_price_1' => '£' . $tradein->order_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 10
    public function orderExpired_em10($user, $tradein){

        $checkPrice = new \App\Services\Testing();
        switch($tradein->customer_grade){
            case 'Excellent Working':
                $bamboogradeval = 5;
                break;
            case 'Good Working':
                $bamboogradeval = 4;
                break;
            case 'Poor Working':
                $bamboogradeval = 3;
                break;
            case 'Damaged Working':
                $bamboogradeval = 2;
                break;
            case 'Faulty':
                $bamboogradeval = 1;
                break;
            default:
            $bamboogradeval = 5;
                break;
        }
        $deviceCurrentPrice = $checkPrice->generateDevicePrice($tradein->product_id, $tradein->customer_memory, $tradein->customer_network, $bamboogradeval);

        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 10',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_10_device_1' => $tradein->getCustomerProductName(),
                    '$em_10_proposed_price_1' => '£' . $deviceCurrentPrice,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 11
    public function orderExpired_em11($user, $tradein){

        $checkPrice = new \App\Services\Testing();
        switch($tradein->customer_grade){
            case 'Excellent Working':
                $bamboogradeval = 5;
                break;
            case 'Good Working':
                $bamboogradeval = 4;
                break;
            case 'Poor Working':
                $bamboogradeval = 3;
                break;
            case 'Damaged Working':
                $bamboogradeval = 2;
                break;
            case 'Faulty':
                $bamboogradeval = 1;
                break;
            default:
            $bamboogradeval = 5;
                break;
        }

        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 11',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_11_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }
    

    /* 
    *   Group Order Types - Print your Own Trade Pack / Free Trade Pack - Device Receipt Email End
    */

    /*
    *   No IMEI - Email Start
    */

    //Testing EM - 3
    public function noImei_testing_em_3($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 3',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_3_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Post Testing EM - 6
    public function paymentEmail_post_testing_em_6($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Post Testing EM - 6',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$post_testing_em_6_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 9
    public function returnDevice_offer_em_9($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 9',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_9_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Post Testing EM - 3
    public function returnDevice_post_testing_em_3($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Post Testing EM - 3',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$post_testing_em_9_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /**
     * No IMEI - Email End
     */

    /**
     * PIN Locked - Email Start
     */

    //Testing EM - 4
    public function pinLocked_testing_em_4($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 4',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_4_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    /**
     * PIN Locked - Email End
     */

    /**
     * FMIP Journey - Email Start
     */
    //Testing EM - 4.1
    public function FMIP_testing_em_4($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 4.1',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_4.1_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Testing EM - 4.2
    public function Google_testing_em_4($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 4.2',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_4.2_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }
    

    /**
     * FMIP Journey - Email End
     */

    /**
    * Incorrect GB Journey  - Email Start
    *
    *public function incorrect_GB_testing_em_3($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 3',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_3_device_1' => $tradein->getCustomerProductName(),
                    '$testing_em_3_new_price' => '£' . $tradein->bamboo_price,
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    *}
    * Incorrect GB Journey  - Email Start
    */

    /**
     *  Device Missing - Email Start
     */
    //Testing EM - 5
    public function deviceMissing_testing_em_5($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Testing EM - 5',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$testing_em_5_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }

    //Offer EM - 8
    public function deviceMissingCancelOrder_offer_em_8($user, $tradein){
        $event = new KlaviyoEvent(
            array(
                'event' => 'Offer EM - 8',
                'customer_properties' => array(
                    '$email' => $user->email,
                    '$em_5_device_1' => $tradein->getCustomerProductName(),
                ),
                'properties' => array(
                    'Item sold' => true
                )
            )
        );

        $this->sendEmail($event);
    }
    /**
     *  Device Missing - Email End
     */

    public function sendEmail($event){
        $response =  $this->client->publicAPI->track( $event ); 

        $toArray = $event->toArray();
        $log = [
            'event' => $toArray['event'],
            // 'properties' => implode(', ', $toArray['properties']),
            'email' => $toArray['customer_properties']['email'],
            'device' => isset($toArray['customer_properties']['$device']) ? $toArray['customer_properties']['$device'] : null,
            'tradein_id' => isset($toArray['customer_properties']['$tradein_id']) ? $toArray['customer_properties']['$tradein_id'] : null,
            //'event' => $event->getEvent(),
            'sent_successfully' => ($response === "1") ? true : false
        ];

        // classmethods -> jsonSerialize, toArray

        // logging channel name
        $orderLog = new Logger('klaviyo_logs');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/klaviyo_logs.log')), Logger::INFO);
        $orderLog->info('KlaviyoLog', $log);
    }


}

?>