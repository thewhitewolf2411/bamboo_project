<?php

namespace App\Helpers;

use App\Eloquent\ProductInformation;
use App\Eloquent\Tradein;

/**
 * Used for calculating & evaluation tradein bamboo_order_price after testing.
 */
class PriceEvaluation {

    public function __construct()
    {
        
    }

    public function evaluatePrice(Tradein $tradein, array $data){
        //dd($tradein->toArray(), $data);
        $product = $tradein->product_id;
        $customer_price = $tradein->order_price;
        $bamboo_grade = $data['bamboo_final_grade'];
        $product_informations = ProductInformation::where('product_id', $product)->get();

        //dd($data['correct_memory_value'], $tradein['memory']);
        $bamboo_price = 0;
        // if memory correct, get value from product info
        if((bool)$data['correct_memory'] === "true"){
            $bamboo_price = $customer_price;
        } else {
            // get price from product information by selected memory
            $price = $product_informations->filter(function($value, $key) use ($data){
                dd($value, $data);
            });
        }
        dd($bamboo_price);
        
        //dd($product_information, $data, $customer_price);
        dd('stani');
    }

    /**
     * Get customer grade state.
     */
    private function getCustomerGrade($bamboo_customer_grade){
        if($bamboo_customer_grade === "Excellent Working"){
            return 5;
        }
        if($bamboo_customer_grade === "Good Working"){
            return 4;
        }
        if($bamboo_customer_grade === "Poor Working"){
            return 3;
        }
        if($bamboo_customer_grade === "Damaged Working"){
            return 2;
        }
        if($bamboo_customer_grade === "Faulty" || $bamboo_customer_grade === "Catastrophic"){
            return 1;
        }
    }
}

?>