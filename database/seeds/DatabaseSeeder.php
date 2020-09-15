<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Crypt as Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //users
        DB::table('users')->insert([

            'first_name'=>'admin',
            'last_name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Crypt::encrypt('Lambda12'),
            'birthdate'=>'24.11.1993',
            'current_phone'=>'3',
            'preffered_os'=>'Android',
            'sub'=>false,
            'username'=>'bambooadmin',
            'delivery_address'=>'Sarajevo',
            'billing_address'=>'Sarajevo',
            'contact_number'=>'061172442',
            'type_of_user'=>3,
            'account_disabled'=>false,
        ]);

        DB::table('users')->insert([

            'first_name'=>'Eren',
            'last_name'=>'Yeager',
            'email'=>'eren@yeager.com',
            'password'=>Crypt::encrypt('Lambda12'),
            'birthdate'=>'24.11.1993',
            'current_phone'=>'2',
            'preffered_os'=>'iOS',
            'sub'=>false,
            'username'=>'eyeager',
            'delivery_address'=>'Sarajevo',
            'billing_address'=>'Sarajevo',
            'contact_number'=>'061172442',
            'type_of_user'=>0,
            'account_disabled'=>false,
        ]);

        DB::table('portal_users')->insert([
            'user_id' => 1,
            'customer_care' => true,
            'categories' => true,
            'product' => true,
            'quarantine' => true,
            'testing' => true,
            'payments' => true,
            'reports' => true,
            'feeds' => true,
            'users' => true,
            'settings' => true,
            'cms' => true,
            'trays' => true,
            'boxes' => true,
        ]);

        DB::table('product_category')->insert([
            'category_name'=>'Mobile Phones',
            'category_description'=>'Mobile Phones',
            'category_image'=>'default_category_image.jpg'
        ]);

        DB::table('product_category')->insert([
            'category_name'=>'Tablets',
            'category_description'=>'Tablets',
            'category_image'=>'default_category_image.jpg'
        ]);

        DB::table('product_category')->insert([
            'category_name'=>'Smartwatches',
            'category_description'=>'Smartwatches',
            'category_image'=>'default_category_image.jpg'
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Apple',
            'brand_image'=>'Image 13_1597675760.png',
            'total_produts'=>3
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Samsung',
            'brand_image'=>'Image 14_1597675775.png',
            'total_produts'=>3
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Huawei',
            'brand_image'=>'/Image 15_1597675746.png',
            'total_produts'=>1
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Google',
            'brand_image'=>'Image 16_1597675717.png',
            'total_produts'=>1
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Oneplus',
            'brand_image'=>'Image 16_1597675717.png',
            'total_produts'=>1
        ]);
        
        /*DB::table('buying_products')->insert([

            'product_name'=>'iPhone X',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'iPhone X',
            'category_id'=>1,
            'brand_id'=>1,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'128GB',
            'product_colour'=>'White',
            'product_grade'=>'A+',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'iOS',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>300
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'iPhone 12',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'iPhone 12',
            'category_id'=>1,
            'brand_id'=>1,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'256GB',
            'product_colour'=>'White',
            'product_grade'=>'B',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'iOS',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>200
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'iPhone 9',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'iPhone 9',
            'category_id'=>1,
            'brand_id'=>1,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'64GB',
            'product_colour'=>'White',
            'product_grade'=>'A+',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'iOS',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>120
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'iPhone X',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'iPhone X',
            'category_id'=>1,
            'brand_id'=>1,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'128GB',
            'product_colour'=>'White',
            'product_grade'=>'A',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'iOS',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>200
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'Samsung Galaxy S10',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'Samsung Galaxy S10',
            'category_id'=>1,
            'brand_id'=>2,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'128GB',
            'product_colour'=>'Black',
            'product_grade'=>'A',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'Android',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>200
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'Samsung Galaxy S20',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'Samsung Galaxy S10',
            'category_id'=>1,
            'brand_id'=>2,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'128GB',
            'product_colour'=>'Black',
            'product_grade'=>'C',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'Android',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>90
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'Samsung Galaxy S20',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'Samsung Galaxy S10',
            'category_id'=>1,
            'brand_id'=>2,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'256GB',
            'product_colour'=>'Black',
            'product_grade'=>'C',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'Android',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>110
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'Huaweii P20 Pro',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'Huaweii P20 Pro',
            'category_id'=>1,
            'brand_id'=>3,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'256GB',
            'product_colour'=>'Black',
            'product_grade'=>'CB',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'Android',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>220
        ]);

        DB::table('buying_products')->insert([

            'product_name'=>'Google Nexus 5',
            'product_image'=>'default_category_image.jpg',
            'product_description'=>'Google Nexus 5',
            'category_id'=>1,
            'brand_id'=>4,
            'product_code_name'=>'abc',
            'product_code_value'=>123456789,
            'product_network'=>'Unlocked',
            'product_memory'=>'256GB',
            'product_colour'=>'Black',
            'product_grade'=>'C',
            'product_dimensions'=>'default',
            'product_processor'=>'default',
            'product_weight'=>'default',
            'product_screen'=>'6.1in',
            'product_system'=>'Android',
            'product_connectivity'=>'WiFi, Bluetooth',
            'product_battery'=>'24hrs',
            'product_signal'=>'3g,4g',
            'product_camera'=>'12MP',
            'product_camera_2'=>'8MP',
            'product_sim'=>'nanosim',
            'product_memory_slots'=>'No',
            'product_quantity'=>3,
            'product_buying_price'=>40
        ]);


        DB::table('selling_products')->insert([

            'product_name'=>'iPhone X',
            'product_image'=>'default_category_image.jpg',
            'category_id'=>1,
            'brand_id'=>1,
            'product_memory'=>'128GB',
            'product_colour'=>'White',
            'product_network'=>'Unlocked',
            'product_grade_1'=>'New',
            'product_grade_2'=>'Good',
            'product_grade_3'=>'Faulty',
            'product_selling_price_1'=>300,
            'product_selling_price_2'=>200,
            'product_selling_price_3'=>100,

        ]);

        DB::table('selling_products')->insert([

            'product_name'=>'iPhone 12',
            'product_image'=>'default_category_image.jpg',
            'category_id'=>1,
            'brand_id'=>1,
            'product_memory'=>'256GB',
            'product_colour'=>'White',
            'product_network'=>'Unlocked',
            'product_grade_1'=>'New',
            'product_grade_2'=>'Good',
            'product_grade_3'=>'Faulty',
            'product_selling_price_1'=>350,
            'product_selling_price_2'=>220,
            'product_selling_price_3'=>110,

        ]);

        DB::table('selling_products')->insert([

            'product_name'=>'Samsung Galaxy S20',
            'product_image'=>'default_category_image.jpg',
            'category_id'=>1,
            'brand_id'=>2,
            'product_memory'=>'256GB',
            'product_colour'=>'White',
            'product_network'=>'Unlocked',
            'product_grade_1'=>'New',
            'product_grade_2'=>'Good',
            'product_grade_3'=>'Faulty',
            'product_selling_price_1'=>250,
            'product_selling_price_2'=>120,
            'product_selling_price_3'=>60,

        ]);*/

    }
}
