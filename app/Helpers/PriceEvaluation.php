<?php

namespace app\Helpers;

use App\Eloquent\Tradein;

/**
 * Used for calculating & evaluation tradein bamboo_order_price after testing.
 */
class PriceEvaluation {

    public function __construct()
    {
        
    }

    public function evaluatePrice(Tradein $tradein, array $data){
        dd($tradein, $data);
    }
}

?>