<?php 

namespace App\Services;

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
        // in receiving process
        if(in_array($tradein->job_state, ['1', '2', '3'])){
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
                if($tradein->job_state === "3"){
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
        if($tradein->job_state === '9'){
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
        if($tradein->job_state === '10' || $tradein->job_state === '12'){
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
            if($tradein->job_state === '25'){
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
        if($tradein->job_state === '14'){
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
    public static function isAlertableStatus(string $job_state):bool
    {
        $alertable_statuses = [
            "4", "4b", "5", "6", "7", 
            "8a", "8b", "8c", "8d", "8e", "8f", 
            "11", "11a", "11b", "11c", "11e", "11f", "11g", "11h", "11i", "11j",
            "15", "15a", "15b", "15c", "15e", "15f", "15g", "15h", "15i", "15j",
            "17", "18"
        ];
        if(in_array($job_state, $alertable_statuses)){
            return true;
        }
        return false;
    }

}