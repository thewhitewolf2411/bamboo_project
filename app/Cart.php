<?php

namespace App;

use App\Product;
use App\Order;
use Illuminate\Http\Request;
use DB;

class Cart{

    public $items = [];

    public function __construct($oldCart){

        if($oldCart){
            $this->items = $oldCart->items;
        }

    }

    public function add($order){
        array_push($this->items, $order);
        
    }
}