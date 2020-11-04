<?php

namespace App\Eloquent;

use App\Eloqunet\BuyingProduct;
use App\Eloquent\SellingProduct;
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

    public function add($price, $item, $type, $network, $memory, $grade){

        $storedItem = ['price'=>$price, 'product'=>$item, 'type'=>$type, 'network'=>$network, 'memory'=>$memory, 'grade'=>$grade];
 
        array_push($this->items, $storedItem);
    }
}