<?php 

namespace App\Services;

use App\Eloquent\JobStateChanged;
use App\Eloquent\Notification;
use App\Eloquent\TestingFaults;
use App\Eloquent\Tradein;
use Illuminate\Support\Facades\Auth;

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
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // order placed
        if($actual_job_state === "1"){
            return [
                'first_roundel'         => null,
                'first_roundel_text'    => '',
                'second_roundel'        => asset(self::$success_icon),
                'second_roundel_text'   => 'Order placed',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting receipt - trade pack despatched
        if($actual_job_state === "2" || $actual_job_state === "3"){
            if($tradein->notReceivedYet()){
                if($tradein->notReceivedAfterSevenDays()){
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Order placed',
                        'second_roundel'        => asset(self::$failed_icon),
                        'second_roundel_text'   => 'Awaiting Response',
                        'third_roundel'         => null,
                        'third_roundel_text'    => '',
                        'sale_status'           => '',
                    ];
                }
                if($tradein->notReceivedAfterTenDays()){
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Order placed',
                        'second_roundel'        => asset(self::$failed_icon),
                        'second_roundel_text'   => 'Awaiting Response',
                        'third_roundel'         => null,
                        'third_roundel_text'    => '',
                        'sale_status'           => '',
                    ];
                }
                if($tradein->notReceivedAfterFourteenDays()){
                    return [
                        'first_roundel'         => asset(self::$success_icon),
                        'first_roundel_text'    => 'Order placed',
                        'second_roundel'        => asset(self::$failed_icon),
                        'second_roundel_text'   => 'Awaiting Response',
                        'third_roundel'         => asset(self::$on_hold_icon),
                        'third_roundel_text'    => 'Order Expired',
                        'sale_status'           => '',
                    ];
                }
            } else {
                return [
                    'first_roundel'         => asset(self::$success_icon),
                    'first_roundel_text'    => 'Order placed',
                    'second_roundel'        => asset(self::$on_hold_icon),
                    'second_roundel_text'   => 'In progress',
                    'third_roundel'         => null,
                    'third_roundel_text'    => '',
                    'sale_status'           => '',
                ];
            }
        }

        // lost in transit - lost in transit
        if($actual_job_state === "4"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // order cancelled - order cancelled
        if($actual_job_state === "4a"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => "",
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Sale canceled',
                'sale_status'           => '',
            ];
        }

        // lost in transit- expired
        if($actual_job_state === "4b"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => "",
                'third_roundel'         => asset(self::$failed_icon),
                'third_roundel_text'    => 'Order expired',
                'sale_status'           => '',
            ];
        }

        // never received - expired
        if($actual_job_state === '5'){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => asset(self::$on_hold_icon),
                'third_roundel_text'    => 'Order Expired',
                'sale_status'           => '',
            ];
        }

        // noe IMEI - awaiting response
        if($actual_job_state === "6"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - awaiting response
        if($actual_job_state === "8a"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - awaiting response
        if($actual_job_state === "8b"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - awaiting response
        if($actual_job_state === "8c"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - awaiting response
        if($actual_job_state === "8d"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - awaiting response
        if($actual_job_state === "8f"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting testing - trade pack received
        if($actual_job_state === '9'){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting testing - test complete
        if($actual_job_state === "9b"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // 1st test - testing
        if($actual_job_state === "10"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // FMIP - awaiting response
        if($actual_job_state === "11a" || $actual_job_state === "15a"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // Google lock - awaiting response
        if($actual_job_state === "11b" || $actual_job_state === "15b"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // PIN Lock - awaiting response
        if($actual_job_state === "11c" || $actual_job_state === "15c"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // incorrect model size - awaiting response
        if($actual_job_state === "11d" || $actual_job_state === "15d"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // downgrade - awaiting response
        if($actual_job_state === "11e" || $actual_job_state === "15e"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

         // incorrect GB size - awaiting response
         if($actual_job_state === "11f" || $actual_job_state === "15f"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // incorrect network - awaiting response
        if($actual_job_state === "11g" || $actual_job_state === "15g"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // downgrade - awaiting response
        if($actual_job_state === "11h" || $actual_job_state === "15h"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // downgrade - awaiting response
        if($actual_job_state === "11i" || $actual_job_state === "15i"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // order not valid - awaiting response (received after 14 days)
        if($actual_job_state === "11j"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // test complete - testing
        if($actual_job_state === "12"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting retesting - device marked for retest
        if($actual_job_state === "13"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // 2nd test - testing 
        if($actual_job_state === "14"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // 2nd test complete - testing 
        if($actual_job_state === "16"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // BLACKLISTED - device sent for destruction
        if($actual_job_state === "17"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => '',
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Device Destroyed',
                'sale_status'           => '',
            ];
        }

        // return to customer - returning device
        if($actual_job_state === "19"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => '',
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Sale Cancelled',
                'sale_status'           => '',
            ];
        }

        // return to customer - returning device
        if($actual_job_state === "20"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => '',
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Sale Cancelled',
                'sale_status'           => '',
            ];
        }

        // despatched to customer - returning device
        if($actual_job_state === "21"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => null,
                'second_roundel_text'   => '',
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Sale Cancelled',
                'sale_status'           => '',
            ];
        }

        // awaiting box build - awaiting payment
        if($actual_job_state === "22"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$success_icon),
                'second_roundel_text'   => 'In progress',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting box build - submitted for payment
        if($actual_job_state === "23"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$on_hold_icon),
                'second_roundel_text'   => 'Testing Complete',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting box build - failed payment
        if($actual_job_state === "24"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$failed_icon),
                'second_roundel_text'   => 'Awaiting Response',
                'third_roundel'         => null,
                'third_roundel_text'    => '',
                'sale_status'           => '',
            ];
        }

        // awaiting box build - paid
        if($actual_job_state === "25"){
            return [
                'first_roundel'         => asset(self::$success_icon),
                'first_roundel_text'    => 'Order placed',
                'second_roundel'        => asset(self::$success_icon),
                'second_roundel_text'   => 'Testing Complete',
                'third_roundel'         => asset(self::$success_icon),
                'third_roundel_text'    => 'Sale Complete',
                'sale_status'           => '',
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
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        $alertable_statuses = [
            "4", "4b", "5", "6", "7", 
            "8a", "8b", "8c", "8d", "8e", "8f", 
            "11", "11a", "11b", "11c", "11d", "11e", "11f", "11g", "11h", "11i", "11j",
            "15", "15a", "15b", "15c", "15d", "15e", "15f", "15g", "15h", "15i", "15j",
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
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
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

        // order cancelled
        if($actual_job_state === "4a"){
            return [];
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

        // awaiting testing - test complete
        if($actual_job_state === "9b"){
            return [
                'emoji'         => asset(self::$p1['emoji']),
                'emoji_text'    => self::$p1['text'],
                'description'   => self::$pvm3
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

        // 17 - blacklisted - N/A ??

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
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
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
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // order placed
        if($actual_job_state === "1"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // awaiting receipt / trade pack despatched
        if($actual_job_state === "2"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // awaiting receipt / trade pack despatched
        if($actual_job_state === "3"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // lost in transit
        if($actual_job_state === "4"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // order cancelled
        if($actual_job_state === "4a"){
            return [];
        }

        // lost in transit / expired
        if($actual_job_state === "4b"){
            return [];
        }

        if($actual_job_state === "5"){
            return [];
        }

        // no imei
        if($actual_job_state === "6"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // blacklisted
        if($actual_job_state === "8a"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // blacklisted
        if($actual_job_state === "8b"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // blacklisted
        if($actual_job_state === "8c"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // blacklisted
        if($actual_job_state === "8d"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // blacklisted
        if($actual_job_state === "8f"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // awaiting testing / test complete
        if($actual_job_state === "9b"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tmv4
            ];
        }

        // awaiting testing
        if($actual_job_state === "9"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // first test
        if($actual_job_state === "10"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm3
            ];
        }

        // FMIP
        if($actual_job_state === "11a" || $actual_job_state === "15a"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // google lock
        if($actual_job_state === "11b" || $actual_job_state === "15b"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // pin lock
        if($actual_job_state === "11c" || $actual_job_state === "15c"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // incorrect model size
        if($actual_job_state === "11d" || $actual_job_state === "15d"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // downgrade
        if($actual_job_state === "11e" || $actual_job_state === "15e"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // incorrect gb size
        if($actual_job_state === "11f" || $actual_job_state === "15f"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // incorrect network
        if($actual_job_state === "11g" || $actual_job_state === "15g"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
            ];
        }

        // downgrade - awaiting response
        if($actual_job_state === "11h" || $actual_job_state === "15h"){
            return [
                'emoji'         => asset(self::$t2['emoji']),
                'emoji_text'    => self::$t2['text'],
                'description'   => self::$tvm8
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

        // order not valid
        if($actual_job_state === "11j"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // test complete
        if($actual_job_state === "12"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm3
            ];
        }

        // awaiting retesting
        if($actual_job_state === "13"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm3
            ];
        }

        // 2nd test
        if($actual_job_state === "14"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm3
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

        // 2nd test complete /
        if($actual_job_state === "16"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm3
            ];
        }

        // blacklisted - sent for destruction
        if($actual_job_state === "17"){
            return [];
        }

        // return to customer
        if($actual_job_state === "19"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm5
            ];
        }

        // return to customer - returning device
        if($actual_job_state === "20"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm5
            ];
        }

        // despatched to customer
        if($actual_job_state === "21"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tvm5
            ];
        }

        // awaiting box build - awaiting payment
        if($actual_job_state === "22"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tmv4
            ];
        }

        // awaiting box build / submitted for payment
        if($actual_job_state === "23"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tmv4
            ];
        }

        // awaiting box build - failed payment
        if($actual_job_state === "24"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tmv4
            ];
        }

        // awaiting box build / paid
        if($actual_job_state === "25"){
            return [
                'emoji'         => asset(self::$t3['emoji']),
                'emoji_text'    => self::$t3['text'],
                'description'   => self::$tmv4
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
        // downgrade                        -> PEM12
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        if($actual_job_state === "11c" || $actual_job_state === "15c"){
            return "PEM8";
        }
        if($actual_job_state === "11a" || $actual_job_state === "15a"){
            return "PEM9";
        }
        if($actual_job_state === "11b" || $actual_job_state === "15b"){
            return "PEM10";
        }

        $testing_faults = ["11d", "11e", "11f", "11g", "15d", "15e", "15f", "15g"];
        if(in_array($actual_job_state, $testing_faults)){
            return "PEM11";
        }

        if($actual_job_state === "11i" || $actual_job_state === "15i" || $actual_job_state === "11h" || $actual_job_state === "15h"){
            return "PEM12";
        }

    }








    /**
     * Payment section variables (images/texts).
     */
    public static $py1 = [
        'emoji' => '/customer_page_images/body/emoji_winking.svg',
        'text'  => "Almost there..."
    ];

    public static $py2 = [
        'emoji' => '/customer_page_images/body/emoji_laughing.svg',
        'text'  => "Success!"
    ];

    public static $py3 = [
        'emoji' => '/customer_page_images/body/emoji_sad.svg',
        'text'  => "Sooo sorry, but...."
    ];

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
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // awaiting testing - trade pack received
        if($actual_job_state === "9"){
            return [
                'emoji'         => asset(self::$py1['emoji']),
                'emoji_text'    => self::$py1['text'],
                'description'   => self::$pyvm1
            ];
        }

        // awaiting testing - test complete
        if($actual_job_state === "9b"){
            return [
                'emoji'         => asset(self::$t1['emoji']),
                'emoji_text'    => self::$t1['text'],
                'description'   => self::$tvm1
            ];
        }

        // test complete - testing
        if($actual_job_state === '12'){
            return [
                'emoji'         => asset(self::$py1['emoji']),
                'emoji_text'    => self::$py1['text'],
                'description'   => self::$pyvm2
            ];
        }

        // pin lock - awaiting response
        if($actual_job_state === "15c"){
            return [
                'emoji'         => asset(self::$py1['emoji']),
                'emoji_text'    => self::$py1['text'],
                'description'   => self::$pyvm1
            ];
        }
        
        // return to customer - returning device
        if($actual_job_state === "19"){
            return [
                'emoji'         => asset(self::$py3['emoji']),
                'emoji_text'    => self::$py3['text'],
                'description'   => self::$pyvm4
            ];
        }

        // awaiting box build - paid
        if($actual_job_state === "25"){
            return [
                'emoji'         => asset(self::$py2['emoji']),
                'emoji_text'    => self::$py2['text'],
                'description'   => self::$pyvm3
            ];
        }

        // never received - expired
        if($actual_job_state === "5"){
            return [];
        }

        // payment failed
        if($actual_job_state === "24"){
            return [
                'emoji'         => asset(self::$py3['emoji']),
                'emoji_text'    => self::$py3['text'],
                'description'   => self::$pyvm6
            ];
        }

        // return empty array - no messages for non-defined scenarios
        return [];
    }


    /**
     * Check if there is payment issues.
     * @param Tradein $tradein
     * @return bool
     */
    public static function hasPaymentIssues(Tradein $tradein): bool
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        if($actual_job_state === "24"){
            return true;
        }
        return false;
    }


    /**
     * Check if tradein has agreed payment price.
     * @param Tradein $tradein
     * @return bool
     */
    public static function hasAgreedPrice(Tradein $tradein): bool
    {
        // if($tradein->bamboo_price === $tradein->order_price){
        //     return true;
        // }
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }
        
        // awaiting box build - awaiting payment
        if($actual_job_state === "22"){
            return true;
        }
        return false;
    }



    /**
     * Check if device has been received in the system.
     * @param Tradein $tradein
     * @return bool
     */
    public static function deviceReceived(Tradein $tradein): bool
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        $matches = ["1","2","3","4","5", "9a"];
        if(in_array($actual_job_state, $matches)){
            return false;
        }
        return true;
    }


    /**
     * Get device type (google/apple).
     * @param Tradein $tradein
     * @return string
     */
    public static function getDeviceType(Tradein $tradein): string
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // google lock
        if($actual_job_state === '11b' || $actual_job_state === '15b'){
            return 'googleInstructions';
        }

        // FMIP lock
        if($actual_job_state === "11a" || $actual_job_state === '15a'){
            return 'appleInstructions';
        }
        
    }


    /**
     * Check if sale is complete.
     * @param Tradein $tradein
     * @return bool
     */
    public static function saleComplete(Tradein $tradein): bool
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // awaiting box build - paid
        if($actual_job_state === '25'){
            return true;
        }
        return false;
    }


    /**
     * Check if tradein has processing alerts.
     * @param Tradein $tradein
     * @return bool
     */
    public static function hasProcessingAlerts(Tradein $tradein): bool
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->whereIn('type', [6,7,8,9,14])
            ->where('tradein_id', $tradein->id)
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }


    /**
     * Check if tradein has testing alerts.
     * @param Tradein $tradein
     * @return bool
     */
    public static function hasTestingAlerts(Tradein $tradein): bool 
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->where('type', 12)
            ->where('tradein_id', $tradein->id)
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }


    /**
     * Check if tradein has payment alerts.
     * @param Tradein $tradein
     * @return bool
     */
    public static function hasPaymentAlerts(Tradein $tradein): bool
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', 'alert')
            ->where('type', 13)
            ->where('tradein_id', $tradein->id)
            ->where('resolved', false)->get();
        if($notifications->count() > 0){
            return true;
        }
        return false;
    }



    /**
     * Get actual customer status.
     * @param Tradein $tradein
     * @return string
     */
    public static function getCustomerStatus(Tradein $tradein): string 
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        // array[0] - bamboo status
        // array[1] - customer status
        // left - database flags
        $states = [
            /*0*/   [],
            /*1*/   ['Awaiting trade pack','Order Placed'],     // old - ['Order Request received','Order Placed']
            /*2*/   ['Awaiting Receipt','Trade Pack Despatched'],
            /*3*/   ['Awaiting Receipt','Trade Pack Despatched'],
            /*4*/   ['Lost in transit','Lost in transit'],
            /*4a*/  ['Order Cancelled','Order Cancelled'],
            /*4b*/  ['Lost in transit','Expired'],
            /*5*/   ['Never Received','Expired'],
            /*6*/   ['No IMEI','Awaiting Response'],
            /*7*/   ['Blacklisted','Awaiting Response'],
            /*8a*/  ['Lost','Awaiting Response'],
            /*8b*/  ['Insurance Claim','Awaiting Response'],
            /*8c*/  ['Blocked/FRP','Awaiting Response'],
            /*8d*/  ['Stolen','Awaiting Response'],
            /*8e*/  ['Knox','Awaiting Response'],
            /*8f*/  ['Assetwatch','Awaiting Response'],
            /*9*/   ['Awaiting Testing','Trade Pack Received'],    // old - ['Awaiting Testing','Awaiting Testing']
            /*9a*/  ['Awaiting Testing','Trade Pack Received'], 
            /*9b*/  ['Awaiting Testing','Test Complete'], 
            /*10*/  ['Test Complete','Testing'],
            /* First Test results */
            /*11*/  ['Quarantine','Awaiting Response'],
            /*11a*/  ['FMIP','Awaiting Response'],
            /*11b*/  ['Google Lock','Awaiting Response'],
            /*11c*/  ['PIN Lock','Awaiting Response'],
            /*11d*/  ['Incorrect Model','Awaiting Response'],
            /*11e*/  ['Device isn\'t fully functional','Awaiting Response'],
            /*11f*/  ['Incorrect GB size','Awaiting Response'],
            /*11g*/  ['Incorrect Network','Awaiting Response'],
            /*11h*/  ['Downgrade','Awaiting Response'],
            /*11i*/  ['Downgrade','Awaiting Response'],
            /*11j*/  ['Order not valid ','Awaiting Response'],
            /*12*/  ['Test complete','Testing'],
            /*13*/  ['Awaiting retesting','Device marked for retest'],
            /*14*/  ['Awaiting retesting','Device marked for retest'],
            /* Second Test results */
            /*15*/  ['2nd Test Quarantine','Awaiting Response'],
            /*15a*/  ['FMIP','Awaiting Response'],
            /*15b*/  ['Google Lock','Awaiting Response'],
            /*15c*/  ['PIN Lock','Awaiting Response'],
            /*15d*/  ['Incorrect Model','Awaiting Response'],
            /*15e*/  ['Downgrade','Awaiting Response'],
            /*15f*/  ['Incorrect GB size','Awaiting Response'],
            /*15g*/  ['Incorrect Network','Awaiting Response'],
            /*15h*/  ['Downgrade','Awaiting Response'],
            /*15i*/  ['Downgrade','Awaiting Response'],
            /*15j*/  ['Order not valid','Awaiting Response'],
            /*16*/  ['2nd test complete','Testing'],
            /*17*/  ['Blacklisted','Order expired'],
            /*18*/  ['Device destroyed','Order expired'],
            /*19*/  ['Return to customer','Returning Device'],
            /*20*/  ['Return to customer','Returning Device'],
            /*21*/  ['Despatched','Returning Device'],
            /*22*/  ['Awaiting Box build','Awaiting payment'],
            /*23*/  ['Awaiting Box build','Submitted for payment'],
            /*24*/  ['Awaiting Box build','Payment Failed'],
            /*25*/  ['Awaiting Box build','Paid'],
            /*26*/  ['Ready For Sale','Paid'],
            /*27*/  ['Closed','Paid'],
            /*28*/  ['Part of sales lot', 'Paid'],
            /*29*/  ['Picked for sales lot', 'Paid'],
        ];

        switch($actual_job_state){
            case "1":
                return $states[1][1];
            case "2":
                return $states[2][1];
            case "3":
                return $states[3][1];
            case "4":
                return $states[4][1];
            case "4a":
                return $states[5][1];
            case "4b":
                return $states[6][1];
            case "5":
                return $states[7][1];
            case "6":
                return $states[8][1];
            case "7":
                return $states[9][1];
            case "8a":
                return $states[10][1];
            case "8b":
                return $states[11][1];
            case "8c":
                return $states[12][1];
            case "8d":
                return $states[13][1];
            case "8e":
                return $states[14][1];
            case "8f":
                return $states[15][1];
            case "9":
                return $states[16][1];
            case "9a":
                return $states[17][1];
            case "9b":
                return $states[18][1];
            case "10":
                return $states[19][1];
            case "11":
                return $states[20][1];
            case "11a":
                return $states[21][1];
            case "11b":
                return $states[22][1];
            case "11c":
                return $states[23][1];
            case "11d":
                return $states[24][1];
            case "11e":
                return $states[25][1];
            case "11f":
                return $states[26][1];
            case "11g":
                return $states[27][1];
            case "11h":
                return $states[28][1];
            case "11i":
                return $states[29][1];
            case "11j":
                return $states[30][1];
            case "12":
                return $states[31][1];
            case "13":
                return $states[32][1];
            case "14":
                return $states[33][1];
            case "15":
                return $states[34][1];
            case "15a":
                return $states[35][1];
            case "15b":
                return $states[36][1];
            case "15c":
                return $states[37][1];
            case "15d":
                return $states[38][1];
            case "15e":
                return $states[39][1];
            case "15f":
                return $states[40][1];
            case "15g":
                return $states[41][1];
            case "15h":
                return $states[42][1];
            case "15i":
                return $states[43][1];
            case "15j":
                return $states[44][1];
            case "16":
                return $states[45][1];
            case "17":
                return $states[46][1];
            case "18":
                return $states[47][1];
            case "19":
                return $states[48][1];
            case "20":
                return $states[49][1];
            case "21":
                return $states[50][1];
            case "22":
                return $states[51][1];
            case "23":
                return $states[52][1];
            case "24":
                return $states[53][1];
            case "25":
                return $states[54][1];
            case "26":
                return $states[55][1];
            case "27":
                return $states[56][1];
            case "28":
                return $states[57][1];
            case "29":
                return $states[58][1];
        }
    }



    /**
     * Get testing faults.
     * @param Tradein $tradein
     */
    public static function getTestingFaults(Tradein $tradein)
    {
        $job_state = JobStateChanged::where('tradein_id', $tradein->id)->first();
        $actual_job_state = null;
        if($job_state->previous_job_state === null){
            $actual_job_state = $job_state->job_state;
        } else {
            if($job_state->sent){
                $actual_job_state = $job_state->job_state;
            } else {
                $actual_job_state = $job_state->previous_job_state;
            }
        }

        $testing_faults = TestingFaults::where('tradein_id', $tradein->id)->first();
        $faults = [];
        $available_faults = [
            "audio_test" => "Audio Test",
            "front_microphone" => "Front Microphone",
            "headset_test" => "Headset Test",
            "loud_speaker_test" => "Loud Speaker Test",
            "microphone_playback_test" => "Microphone Playback Test",
            "buttons_test" => "Buttons Test",
            "sensor_test" => "Sensor Test",
            "camera_test" => "Camera Test",
            "glass_condition" => "Glass Condition",
            "vibration" => "Vibration",
            "original_colour" => "Original Colour",
            "battery_health" => "Battery Health",
            "nfc" => "NFC",
            "no_power" => "No Power",
            "fake_missing_parts" => "Fake Missing Parts",
            "knox_removed"=>"Knox Removed"
        ];

        // Incorrect GB size
        if($actual_job_state === "15f" || $actual_job_state === "11f"){
            array_push($faults, "Incorrect GB Size - [".$tradein->correct_memory ."]");
        }
        // incorrect network
        if($actual_job_state === "15g" || $actual_job_state === "11f"){
            array_push($faults, "Incorrect Network - [" . $tradein->correct_network ."]");
        }
        // incorrect model
        if($actual_job_state === "15d" || $actual_job_state === "11d"){
            array_push($faults, "Incorrect Model - [". $tradein->getProductName() ."]");
        }

        // downgrade
        if($actual_job_state === "11i" || $actual_job_state === "15i" || $actual_job_state === "11h" || $actual_job_state === "15h"){
            array_push($faults, "Device does not meet expected requirements. Device grade is: ". $tradein->bamboo_grade);
        }

        if($testing_faults){
            foreach($available_faults as $fault => $text){
                if($testing_faults[$fault] !== null){
                    array_push($faults, $text);
                }
            }
        }

        if(count($faults) > 0){
            return implode('<br>', $faults);
        }

        return null;
    }
}