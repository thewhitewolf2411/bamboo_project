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

    public function AccountCreated($user){

        $event = new KlaviyoEvent(
            array(
                'event' => 'Registration',
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