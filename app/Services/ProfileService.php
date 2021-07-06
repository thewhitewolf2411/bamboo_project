<?php 

namespace App\Services;

use App\Eloquent\JobStateChanged;
use App\Eloquent\Tradein;

class ProfileService{

    // images for roundels
    public static $on_hold_icon    = '/customer_page_images/body/grey_circle.png';
    public static $failed_icon   = '/customer_page_images/body/error_alert.svg';
    public static $success_icon  = '/customer_page_images/body/Icon-Tick-Selected.svg';

    /**
     * Get sale status information.
     * @param Tradein $tradein
     * @return array
     */
    public static function getSaleStatus(Tradein $tradein):array
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->get()->last();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }

        // in receiving process
        if(in_array($actual_job_state, ['1', '2', '3'])){
            if($tradein->notReceivedYet()){
                return [
                    'first_roundel'         => asset(self::$success_icon),
                    'first_roundel_text'    => 'Order placed',
                    'second_roundel'        => asset(self::$on_hold_icon),
                    'second_roundel_text'   => 'Trade Pack Despatched',
                    'third_roundel'         => asset(self::$on_hold_icon),
                    'third_roundel_text'    => 'Receiving',
                    'sale_status'           => 'Oh no! It looks like there is something holding up your sale.<br>
                    Please check processing section to help us resolve the issue and speed up your sale.',
                ];
            } else {
                if($actual_job_state === "3"){
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Order placed',
                        'second_roundel'        => asset(self::$on_hold_icon),
                        'second_roundel_text'   => 'Trade Pack Despatched',
                        'third_roundel'         => asset(self::$on_hold_icon),
                        'third_roundel_text'    => 'Receiving',
                        'sale_status'           => 'Your order is being recieved.',
                    ];
                } else {
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Order placed',
                        'second_roundel'        => asset(self::$on_hold_icon),
                        'second_roundel_text'   => 'Trade Pack Despatched',
                        'third_roundel'         => asset(self::$on_hold_icon),
                        'third_roundel_text'    => 'Receiving',
                        'sale_status'           => 'Your order is waiting for despatch.',
                    ];
                }
               
            }
        }

        // awaiting testing
        if($actual_job_state === '9'){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Trade Pack Received',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'Testing',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Submitted for payment',
                'sale_status'           => 'Your order is awaiting testing.',
            ];
        }

        // test complete
        if($actual_job_state === '10' || $actual_job_state === '12'){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Testing',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'Submitted for payment',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Payment confirmed',
                'sale_status'           => 'Your order is awaiting for payment.',
            ];
        }

        // payment statuses
        if($tradein->deviceInPaymentProcess()){
            if($actual_job_state === '25'){
                return [
                    'first_roundel'         => asset(self::$success_icon),
                    'first_roundel_text'    => 'Trade Pack received',
                    'second_roundel'        => asset(self::$success_icon),
                    'second_roundel_text'   => 'Submitted for payment',
                    'third_roundel'         => asset(self::$on_hold_icon),
                    'third_roundel_text'    => 'Sale complete',
                    'sale_status'           => 'Your order is being submitted for payment.',
                ];
            } else {
                if($tradein->paymentFailed()){
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Testing',
                        'second_roundel'        => asset(self::$failed_icon),
                        'second_roundel_text'   => 'Awaiting response',
                        'third_roundel'         => asset(self::$on_hold_icon),
                        'third_roundel_text'    => 'Submitted for payment',
                        'sale_status'           => 'Oh no! It looks like there is something holding up your sale.<br>
                        Please check payment section to help us resolve the issue and speed up your sale.',
                    ];
                } else {
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Submitted for payment',
                        'second_roundel'        => asset(self::$on_hold_icon),
                        'second_roundel_text'   => 'Payment confirmed',
                        'third_roundel'         => asset(self::$on_hold_icon),
                        'third_roundel_text'    => 'Sale complete',
                        'sale_status'           => 'Your order is being submitted for payment.',
                    ];
                }
            }
            
        }

        // processing fails
        if($tradein->stuckAtProcessing()){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Trade pack recieved',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting response',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Testing',
                'sale_status'           => 'Oh no! It looks like there is something holding up your sale.
                Please check processing section to help us resolve the issue and speed up your sale.',
            ];

        }

        // testing fails
        if($tradein->hasFailedTesting()){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Trade pack recieved',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting response',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Submitted for payment',
                'sale_status'           => 'Oh no! It looks like there is something holding up your sale.<br>
                Please check testing section to help us resolve the issue and speed up your sale.',
            ];
        }

        // awaiting retesting
        if($actual_job_state === '14'){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Trade pack recieved',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'Testing',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Submitted for payment',
                'sale_status'           => 'Your order is awaiting second testing.',
            ];
        }

        // device in return process
        if($tradein->deviceInReturnProcess()){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Trade pack recieved',
                'second_roundel'        => asset(self::$success_icon),
                'second_roundel_text'   => 'Sent to despatch',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Returned to customer',
                'sale_status'           => 'Your device is in return process.',
            ];
        }


    }

    /**
     * Check if tradein status is alertabled (userprofile/my sales tab)
     * @param string $job_state
     */
    public static function isAlertableStatus(Tradein $tradein):bool
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }

        $alertable_statuses = [
            "4", "4b", "5", "6", "7", 
            "8a", "8b", "8c", "8d", "8e", "8f", 
            "11", "11a", "11b", "11c", "11e", "11f", "11g", "11h", "11i", "11j",
            "15", "15a", "15b", "15c", "15e", "15f", "15g", "15h", "15i", "15j",
            "17", "18"
        ];
        if(in_array($actual_job_state, $alertable_statuses)){
            return true;
        }
        return false;
    }






    /**
     * Processing section statuses variables (images/texts).
     */
    public static $p1 = [
        'emoji' => '/customer_page_images/body/emoji_emotionless.svg',
        'text'  =>  "We're on it..."
    ];

    public static $p2 = [
        'emoji' => '/customer_page_images/body/emoji_sad.svg',
        'text'  => "Sooo sorry, but...."
    ];

    public static $p3 = [
        'emoji' => '/customer_page_images/body/emoji_winking.svg',
        'text' => "Almost there..."
    ];

    public static $pvm1     = "As soon as we receive your device, it will be processed with Boo & the Team. Keep an eye out below for updates.";
    public static $p1vm2    = "We have received your device and it is currently being booked in with Boo and the team";
    public static $pvm3     = "Processing is complete., check back for updates below";
    public static $pvm4     = "Processing Complete! We’re working on your return request";
    public static $pvm5     = "We’ve ran into an issue when processing your order, please see below for details";

    


    /**
     * Get processing section status.
     * @param Tradein $tradein
     * @return array
     */
    public static function getProcessingStatus(Tradein $tradein): array
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }

        // pending device receiving
        if($actual_job_state === "1"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm1
            ];
        }
        // print your own - customer inbound
        if($actual_job_state === "2"){
            if($tradein->notReceivedYet()){
                if($tradein->notReceivedAfterSevenDays()){
                    return [
                        'emoji'         => asset(self::$p3['emoji']),
                        'emoji_text'    => self::$p3['text'],
                        'description'   => self::$pvm1
                    ];
                }
                if($tradein->notReceivedAfterTenDays()){
                    return [
                        'emoji'         => asset(self::$p3['emoji']),
                        'emoji_text'    => self::$p3['text'],
                        'description'   => self::$pvm1
                    ];
                }
                if($tradein->notReceivedAfterFourteenDays()){
                    return [
                        'emoji'         => asset(self::$p2['emoji']),
                        'emoji_text'    => self::$p2['text'],
                        'description'   => self::$pvm5
                    ];
                }
            } else {
                return [
                    'emoji'         => asset(self::$p1['emoji']),
                    'emoji_text'    => self::$p1['text'],
                    'description'   => self::$pvm1
                ];
            }
        }

        // customer converts to free trade pack ??? TODO
        if($actual_job_state === "3"){
            if($tradein->notReceivedYet()){
                if($tradein->notReceivedAfterSevenDays()){
                    return [
                        'emoji'         => asset(self::$p3['emoji']),
                        'emoji_text'    => self::$p3['text'],
                        'description'   => self::$pvm1
                    ];
                }
                if($tradein->notReceivedAfterTenDays()){
                    return [
                        'emoji'         => asset(self::$p3['emoji']),
                        'emoji_text'    => self::$p3['text'],
                        'description'   => self::$pvm1
                    ];
                }
                if($tradein->notReceivedAfterFourteenDays()){
                    return [
                        'emoji'         => asset(self::$p2['emoji']),
                        'emoji_text'    => self::$p2['text'],
                        'description'   => self::$pvm5
                    ];
                }
            } else {
                return [
                    'emoji'         => asset(self::$p1['emoji']),
                    'emoji_text'    => self::$p1['text'],
                    'description'   => self::$pvm1
                ];
            }
        }

        // lost in transit
        if($actual_job_state === "4"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // no imei
        if($actual_job_state === "6"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // blacklisted - awaiting response
        if($actual_job_state === "7"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // blacklisted
        if($actual_job_state === "8a"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // blacklisted
        if($actual_job_state === "8b"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // blacklisted
        if($actual_job_state === "8c"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // blacklisted
        if($actual_job_state === "8d"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // blacklisted - sent for destruction
        if($actual_job_state === "8f"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // trade pack received - awaiting testing
        if($actual_job_state === "9"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$p1vm2
            ];
        }

        // first test
        if($actual_job_state === "10"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // FMIP
        if($actual_job_state === "11a" || $actual_job_state === "15a"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // Google lock
        if($actual_job_state === "11b" || $actual_job_state === "15b"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // pin lock
        if($actual_job_state === "11c" || $actual_job_state === "15c"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // incorrect model size
        if($actual_job_state === "11d" || $actual_job_state === "15d"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // downgrade
        if($actual_job_state === "11e" || $actual_job_state === "15e"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // incorrect gb size
        if($actual_job_state === "11f" || $actual_job_state === "15f"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // incorrect network
        if($actual_job_state === "11g" || $actual_job_state === "15g"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // downgrade
        if($actual_job_state === "11h" || $actual_job_state === "15h"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // downgrade
        if($actual_job_state === "11i" || $actual_job_state === "15i"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // order not valid
        if($actual_job_state === "11j"){
            return [
                'emoji'         => asset(self::$p2['emoji']),
                'emoji_text'    => self::$p2['text'],
                'description'   => self::$pvm5
            ];
        }

        // test complete
        if($actual_job_state === "12"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // awaiting retesting
        if($actual_job_state === "13"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // 2nd test
        if($actual_job_state === "14"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }
        
        // 2nd testing complete
        if($actual_job_state === "16"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // 17 - blacklisted - N/A

        // return to customer
        if($actual_job_state === "19"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm4
            ];
        }

        // return to customer
        if($actual_job_state === "20"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm4
            ];
        }

        // despatched to customer
        if($actual_job_state === "21"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm4
            ];
        }

        // awaiting box build / awaiting payment
        if($actual_job_state === "22"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // awaiting box build / submitted for payment
        if($actual_job_state === "23"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // awaiting box build / failed payment
        if($actual_job_state === "24"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

        // awaiting box build / paid
        if($actual_job_state === "25"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
            ];
        }

    }


    /**
     * Return processing error codename.
     * @param Tradein $tradein
     */
    public static function getProcessingError(Tradein $tradein)
    {
        // if not received after 7 days     -> PEM1
        // if not received after 10 days    -> PEM2
        // if not received after 14 days    -> PEM3
        // if received after 14 days        -> PEM4
        // no imei                          -> PEM5
        // reported as stolen               -> PEM6
        // no device                        -> PEM7
        // blacklisted - with reason        -> PEM-B

        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }
        
        if($tradein->notReceivedAfterSevenDays()){
            return "PEM1";
        }
        if($tradein->notReceivedAfterTenDays()){
            return "PEM2";
        }
        if($tradein->notReceivedAfterFourteenDays()){
            return "PEM3";
        }
        if($actual_job_state === "11j"){
            return "PEM4";
        }
        if($actual_job_state === "6"){
            return "PEM5";
        }
        if($actual_job_state === "8d"){
            return "PEM6";
        }
        if($actual_job_state === "4"){
            return "PEM7";
        }

        if(in_array($actual_job_state, ['7', '8a', '8b', '8c', '8e', '8f'])){
            return "PEM-B";
        }

        return null;
    }









    /**
     * Testing section statuses variables (images/texts).
     */
    public static $t1 = [
        'emoji' => '/customer_page_images/body/emoji_winking.svg',
        'text' => "Almost there..."
    ];

    public static $t2 = [
        'emoji' => '/customer_page_images/body/emoji_sad.svg',
        'text' => "Sooo sorry, but...."
    ];

    public static $t3 = [
        'emoji' => '/customer_page_images/body/emoji_emotionless.svg',
        'text' => "We're on it..."
    ];

    public static $tvm1 = "We’re working on your order.";
    public static $tvm3 = "Your device is in testing! We’ll let you know your test results as soon as we do. Check back for updates";
    public static $tmv4 = "Your device passed our checks! Your payment request has been submitted, check below for payment advise and get “pay day” planning!";
    public static $tvm5 = "Testing Complete! We’re working on your return request";
    public static $tvm8 = "We have encountered an issue whilst trying to test your device, please check below to see your resolution options";



    /**
     * Get testing section status.
     * @param Tradein $tradein
     * @return array
     */
    public static function getTestingStatus(Tradein $tradein): array 
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }

        // order placed
        if($actual_job_state === "1"){
            return [];
        }

        // awaiting testing
        if($actual_job_state === "9"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // downgrade
        if($actual_job_state === "11i" || $actual_job_state === "15i"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // testing faults
        if($actual_job_state === "15e" || $actual_job_state === "15i"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }


    }


    /**
     * Get testing error codename.
     * @param Tradein $tradein
     */
    public static function getTestingError(Tradein $tradein)
    {
        // pattern/pin lock                 -> PEM8
        // FMIP lock                        -> PEM9
        // google lock                      -> PEM10
        // testing faults/gb size/condition -> PEM11
        // cosmetic condition (catastrophic)-> PEM12 ??
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            $actual_job_state = $job_state->previous_job_state;
        }

        if($tradein->isPinLocked()){
            return "PEM8";
        }
        if($actual_job_state === "11a" || $actual_job_state === "15a"){
            return "PEM9";
        }
        if($tradein->isGoogleLocked()){
            return "PEM10";
        }
        if($tradein->getTestingFaults() !== null){
            return "PEM11";
        }

    }








    /**
     * Payment section variables (images/texts).
     */
    public static $payment_emoji_py1     = '/customer_page_images/body/emoji_winking.svg'; 
    public static $payment_emoji_py2     = '/customer_page_images/body/emoji_laughing.svg';
    public static $payment_emoji_py3     = '/customer_page_images/body/emoji_sad.svg';

    public static $payment_emoji_py1_text = "Almost there...";
    public static $payment_emoji_py2_text = "Success!";
    public static $payment_emoji_py3_text = "Sooo sorry, but....";

    public static $pyvm1 = "We’ll let you know the status of your payment once your device has completed our checks.";
    public static $pyvm2 = "We are processing your payment…";
    public static $pyvm3 = "Woohoo! It’s pay day! You should have received payment for your product_name";
    public static $pyvm4 = "Sadly we won’t be making payment to you on this occasion, your device is getting ready to come home…";
    public static $pyvm5 = "Your device has been returned; no payment required";
    public static $pyvm6 = "We have encountered an issue whilst trying to submit your payment. Please ensure your payment details are correct";
    public static $pyvm8 = "Woohoo! It’s pay day! Your payment for your product_name is on its way to you, keep an eye on the post!";



    /**
     * Get payment section status.
     * @param Tradein $tradein
     * @return array
     */
    public static function getPaymentSectionStatus(Tradein $tradein): array
    {
        return [];
    }

}