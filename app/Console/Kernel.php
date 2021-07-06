<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Eloquent\Cart;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\EventModel as KlaviyoEvent;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CheckJobState::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){

            $cart = Cart::where('created_at', '<=', \Carbon\Carbon::now()->subMinutes(30))->where('email_sent', false)->get();

            foreach($cart as $cartitem){
                $email = $cartitem->getUserEmail($cartitem->user_id);
                $firstname = $cartitem->getUserName($cartitem->user_id);
                $lastname = $cartitem->lastName($cartitem->user_id);

                $client = new Klaviyo( 'pk_2e5bcbccdd80e1f439913ffa3da9932778', 'UGFHr6' );
                $event = new KlaviyoEvent(
                    array(
                        'event' => 'Cart abandoned',
                        'customer_properties' => array(
                            '$email' => $email,
                            '$name' => $firstname,
                            '$last_name' => $lastname,
                        ),
                        'properties' => array(
                            'Item Sold' => True
                        )
                    )
                );

                $cart->email_sent = true;
                $cart->save();
            }

        })->everyMinute();

        $schedule->command('CheckJobState')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
