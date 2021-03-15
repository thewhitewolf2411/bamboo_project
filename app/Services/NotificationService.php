<?php

namespace App\Services;

use App\Eloquent\Notification;
use App\User;

class NotificationService {

    public $types = [
        1,  // sign up              - singed up to newsletter
        // 2,  // sign up           - not singed up to newsletter (disabled)
        // 3,  // contact us        - contact us form or device valuation (disabled)

        4,  // checkout             - item sold to bamboo (own label) max 3 sent

        5,  // checkout             - item sold to bamboo (trade pack)

        6,  // not received yet notification
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
                    'resolved'              => false
                ]);
                break;
            case 4:
                Notification::create([
                    'user_id'               => $user->id,
                    'tradein_id'            => $tradein->id,
                    'type'                  => $type,
                    'status'                => 'info',
                    'content'               => 'Order placed. Woohoo! Your order has been placed.',
                    'order'                 => 1,
                    'resolved'              => false
                ]);
                break;
            case 5:
                Notification::create([
                    'user_id'               => $user->id,
                    'tradein_id'            => $tradein->id,
                    'type'                  => $type,
                    'status'                => 'info',
                    'content'               => 'Order placed. Woohoo! Your order has been placed, a Trade Pack will be sent out to you shortly.',
                    'order'                 => 1,
                    'resolved'              => false
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
    }

}