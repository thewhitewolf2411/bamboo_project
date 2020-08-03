<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'password'=>Hash::make('Lambda12'),
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

        DB::table('product_category')->insert([

            'category_name'=>'mobile_devices',
            'category_description'=>'A mobile device is a general term for any type of handheld computer. These devices are designed to be extremely portable, and they can often fit in your hand.',
            'category_image'=>'mobile_image.jpeg'
            ]);
        DB::table('product_category')->insert([

            'category_name'=>'tablets',
            'category_description'=>'A tablet, or tablet PC, is a portable computer that uses a touchscreen as its primary input device.',
            'category_image'=>'tablet_image.jpeg'
            ]);
        DB::table('product_category')->insert([

            'category_name'=>'accesories',
            'category_description'=>'All kinds of accesories for smart devices.',
            'category_image'=>'accesories_image.jpeg'
            ]);
        DB::table('product_category')->insert([

            'category_name'=>'watches',
            'category_description'=>'A smartwatch is a digital watch that provides many other features besides timekeeping.',
            'category_image'=>'watches_image.jpeg'
            ]);


        DB::table('brand')->insert([
            'brand_name'=>'Apple',
            'brand_image'=>'apple_image.jpeg',
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Samsung',
            'brand_image'=>'samsung_image.jpeg',
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'HTC',
            'brand_image'=>'htc_image.jpeg',
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Huaweii',
            'brand_image'=>'huaweii_image.jpeg',
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Nokia',
            'brand_image'=>'nokia_image.jpeg',
        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);

        DB::table('products')->insert([

            'product_name' => "iPhone 11",
            'product_image' => 'iphone_11_image.jpg',
            'product_description' => Str::random(350),
            'category_id' => 1,
            'brand_id' => 1,
            'product_network' => 'EE',
            'product_memory' => '64GB',
            'product_colour' => '#ba0c2f',
            'product_grade' => 'A+',
            'product_dimensions' => "150.9x75.7x8.3",
            'product_processor' => 'Apple A13 Bionic',
            'product_weight' => '188g',
            'product_screen' => '6.1',
            'product_system' => 'iOS',
            'product_connectivity' => 'wlan, bluetooth, gps, radio, usb',
            'product_battery' => '3110 mAh',
            'product_signal' => 'g3, g4',
            'product_camera' => '12 MP',
            'product_sim' => 'Single SIM',
            'product_memory_slots' => 'No',
            'product_quantity'=>3,
            'base_price' => '629'

        ]);


    }
}
