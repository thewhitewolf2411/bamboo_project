<?php

namespace App\Services;

use App\Eloquent\Notification;
use App\Eloquent\Tradein;
use App\User;

class NotificationService {

    public $types = [
        1,  // sign up              - singed up to newsletter                               (info)
        // 2,  // sign up           - not singed up to newsletter (disabled)                (info)
        // 3,  // contact us        - contact us form or device valuation (disabled)        (info)
        4,  // checkout             - item sold to bamboo (own label) max 3 sent            (info)
        5,  // checkout             - item sold to bamboo (trade pack)                      (info)

        6,  // not received yet                     (alert)[processing]
        7,  // no imei                              (alert)[processing]
        8,  // missing device                       (alert)[processing]
        9,  // imei blacklisted                     (alert)[processing]
        10, // marked to return
        11, // sent to despatch 
        12, // testing notification                 (alert)[testing]
        13, // unsuccessful payment                 (alert)[payment]
        14, // trade pack received after 14 days    (alert)[processing]

        15, // order cancelled                      (info)
    ];

    public $states = [
        'info',
        'alert'
    ];

    public function send(User $user, $type, $tradein = null){
        switch ($type) {
            case 1:
                Notification::create([
                    'user_id'               => $user->id,
                    'tradein_id'            => null,
                    'type'                  => $type,
                    'status'                => 'info',
                    'content'               => 'Welcome, thank you for choosing Bamboo Mobile.',
                    'order'                 => 1,
                    'resolved'              => true
                ]);
                break;
            case 4:
                Notification::create([
                    'user_id'               => $user->id,
                    'tradein_id'            => $tradein->id,
                    'type'                  => $type,
                    'status'                => 'info',
                    'content'               => 'Status update: Order placed. Woohoo! Your order has been placed.',
                    'order'                 => 1,
                    'resolved'              => true
                ]);
                break;
            case 5:
                Notification::create([
                    'user_id'               => $user->id,
                    'tradein_id'            => $tradein->id,
                    'type'                  => $type,
                    'status'                => 'info',
                    'content'               => 'Status update: Order placed. Woohoo! Your order has been placed, a Trade Pack will be sent out to you shortly.',
                    'order'                 => 1,
                    'resolved'              => true
                ]);
                break;
            default:
                # code...
                break;
        }
    }

    public function sendNotReceivedYet($tradein){
        $notifications = Notification::where('tradein_id', $tradein->id)->where('user_id', $tradein->user_id)->where('type', 6)->get();
        if($notifications->count() === 0){
            // first notification of device not received
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 6,
                'status'                => 'alert',
                'content'               => 'Device not received after 7 days.',
                'order'                 => 1,
                'resolved'              => false
            ]);
        }
        if($notifications->count() === 1){
            // second notification of device not received
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 6,
                'status'                => 'alert',
                'content'               => 'Device not received after 10 days.',
                'order'                 => 2,
                'resolved'              => false
            ]);
        }
        if($notifications->count() === 2){
            // third notification of device not received
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 6,
                'status'                => 'alert',
                'content'               => 'Device not received after 14 days.',
                'order'                 => 3,
                'resolved'              => false
            ]);
        }
    }

    public function sendNoIMEI($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 7,
            'status'                => 'alert',
            'content'               => 'No IMEI found on device.',
            'order'                 => 1,
            'resolved'              => false
        ]);
    }

    public function sendMissingDevice($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 8,
            'status'                => 'alert',
            'content'               => 'No device in packaging.',
            'order'                 => 1,
            'resolved'              => false
        ]);
    }

    public function sendBlacklisted($tradein){
        $notifications = Notification::where('tradein_id', $tradein->id)->where('user_id', $tradein->user_id)->where('type', 9)->get();
        if($notifications->count() === 1){
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 9,
                'status'                => 'alert',
                'content'               => 'Your device is still in quarantine. Device will be destroyed if we do not hear from you in 28 days.',
                'order'                 => 2,
                'resolved'              => false
            ]);
        }
        if($notifications->count() === 0) {
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 9,
                'status'                => 'alert',
                'content'               => 'This device has been reported as blacklisted. Reason: ' . $tradein->quarantine_reason . '.',
                'order'                 => 1,
                'resolved'              => false
            ]);
        }
    }

    public function sendMarkedToReturn($tradein_id){
        $tradein = Tradein::find($tradein_id); 
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 10,
            'status'                => 'info',
            'content'               => 'Status Update: Order Cancelled ['.$tradein->barcode.'].',
            'order'                 => 1,
            'resolved'              => true
        ]);    
    }

    public function sendDespatched($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 11,
            'status'                => 'info',
            'content'               => 'Status Update: Your device has been returned to you.',
            'order'                 => 1,
            'resolved'              => true
        ]);    
    }

    public function testingSuccess($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 12,
            'status'                => 'info',
            'content'               => 'Status Update: Woohoo! Your device has successfully passed our tests.',
            'order'                 => 1,
            'resolved'              => true
        ]);    
    }

    public function secondTestingSuccess($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 12,
            'status'                => 'info',
            'content'               => 'Status Update: Woohoo! Your device has successfully passed our tests.',
            'order'                 => 1,
            'resolved'              => true
        ]);    
    }

    public function sendTestingFailed($tradein, $reason){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 12,
            'status'                => 'alert',
            'content'               => $reason,
            'order'                 => 1,
            'resolved'              => false
        ]);    
    }

    public function paymentUnsuccessful($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 13,
            'status'                => 'alert',
            'content'               => 'Payment was unsuccessful.',
            'order'                 => 1,
            'resolved'              => false
        ]); 
    }

    public function unsuccessfulPaymentReminder($tradein, $order){
        $notifications_count = Notification::where('tradein_id', $tradein->id)->where('user_id', $tradein->user_id)->where('type', 13)->get()->count();

        if($order === 1 && $notifications_count === 1){
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 13,
                'status'                => 'alert',
                'content'               => 'We still need your payment details.',
                'order'                 => 2,
                'resolved'              => false
            ]); 
        }

        if($order === 2 && $notifications_count === 2){
            Notification::create([
                'user_id'               => $tradein->user_id,
                'tradein_id'            => $tradein->id,
                'type'                  => 13,
                'status'                => 'alert',
                'content'               => 'Correct payment details still not received. Cheque has been despatched.',
                'order'                 => 3,
                'resolved'              => false
            ]); 
        }
    }

    public function receivedAfterFourteenDays($tradein){
        Notification::create([
            'user_id'               => $tradein->user_id,
            'tradein_id'            => $tradein->id,
            'type'                  => 14,
            'status'                => 'alert',
            'content'               => 'Trade pack received after 14 days. A new offer has been sent.',
            'order'                 => 1,
            'resolved'              => false
        ]); 
    }

    public function orderCancelled($tradein_id, $user_id){
        Notification::create([
            'user_id'               => $user_id,
            'tradein_id'            => null,
            'type'                  => 15,
            'status'                => 'info',
            'content'               => 'Status Update: Order Cancelled ['.$tradein_id.']',
            'order'                 => 1,
            'resolved'              => false
        ]); 
    }
}