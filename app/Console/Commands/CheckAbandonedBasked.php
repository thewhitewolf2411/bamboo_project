<?php

namespace App\Console\Commands;

use App\Eloquent\Cart;
use App\Services\KlaviyoEmail;
use Illuminate\Console\Command;

class CheckAbandonedBasked extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckAbandonedBasket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cartItems = Cart::where('email_sent', false)->get();
        $klaviyoEmail = new KlaviyoEmail();


        foreach($cartItems as $cartItem){

            if(\Carbon\Carbon::parse($cartItem->created_at)->diffInDays(\Carbon\Carbon::now()) >= 1){
                $user = $cartItem->getUser();
                $product = $cartItem->getProduct();

                $klaviyoEmail->sendAbandonedBasketEmail($user, $product);

                $cartItem->email_sent = true;
                $cartItem->save();
            }
        }
    }
}
