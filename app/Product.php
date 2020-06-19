<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'product_name', 'product_description','product_image', 'product_code_sku', 
        'product_code_mpn','product_code_gtin', 'product_code_upc', 'product_code_ean','product_code_isbn', 
        'product_code_extension_1', 'product_code_extension_2','network','price_new','price_working_a',
        'price_working_b','price_working_c','price_faulty','price_damaged','quantity',
    ];
}
