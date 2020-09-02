<?php

namespace App\Eloquent;

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

    public function add($item, $price){

        $storedItem = ['state'=>$price, 'item'=>$item];
 
        array_push($this->items, $storedItem);
    }
}