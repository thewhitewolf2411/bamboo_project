<?php

namespace App\Services;

use App\Eloquent\Tradein;

class ReceivingService{

    private Tradein $tradein;


    public function __construct(Tradein $tradein)
    {
        $this->tradein = $tradein;
    }

    

}
