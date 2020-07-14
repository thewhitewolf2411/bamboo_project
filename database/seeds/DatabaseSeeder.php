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
            'type_of_user'=>3,
            'account_disabled'=>false,
        ]);
        DB::table('portal_users')->insert([

            'user_id'=>1,
            'superuser'=>true,
            'trade_pack_dispach_system' => true,
            'dispach_portal_delivery_receiving_system' => true,
            'device_tester_stock_managment' => true,
            'stock_managment' => true,
            'stock_managment_delivery_receiving_system' => true,
            'quarantine_managamnet_and_customer_returns' => true,
            'tray_managment_system' => true,
            'sales_and_dispach' => true,
            'stock_transfer' => true,
            'device_managment' => true,
            'box_managment_system' => true,
            'device_testing' => true,
            'user_managment' => true,
            'reports_and_statistics' => true,
        ]);
        DB::table('users')->insert([
            'first_name' => "Eren",
            'last_name' => "Yeager",
            'email' => "eren@yeager.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Mikasa",
            'last_name' => "Ackerman",
            'email' => "mikasa@ackerman.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'iPhone X',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Ymir",
            'last_name' => "Fritz",
            'email' => "ymir@fritz.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Annie",
            'last_name' => "Leonheart",
            'email' => "annie@leonheart.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Jean",
            'last_name' => "Kirstien",
            'email' => "jean@kirstien.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Armin",
            'last_name' => "Arlert",
            'email' => "armin@Arlert.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);
        DB::table('users')->insert([
            'first_name' => "Lee",
            'last_name' => "Sin",
            'email' => "Lee@sin.com",
            'birthdate' => "March 30th, 835",
            'password' => Hash::make(Str::random(10)),
            'current_phone' => rand(0, 5),
            'preffered_os' => 'Android',
            'sub' => false,
        ]);

        //Categories
        DB::table('product_category')->insert([
            'category_name'=>'Apple',
            'category_description'=>'Apple',
            'category_image'=>'default_category_image.jpg',
        ]);
        DB::table('product_category')->insert([
            'category_name'=>'BlackBerry',
            'category_description'=>'BlackBerry',
            'category_image'=>'default_category_image.jpg',
        ]);
        DB::table('product_category')->insert([
            'category_name'=>'HTC',
            'category_description'=>'HTC',
            'category_image'=>'default_category_image.jpg',
        ]);
        DB::table('product_category')->insert([
            'category_name'=>'Huawei',
            'category_description'=>'Huawei',
            'category_image'=>'default_category_image.jpg',
        ]);
        DB::table('product_category')->insert([
            'category_name'=>'LG',
            'category_description'=>'LG',
            'category_image'=>'default_category_image.jpg',
        ]);

        //products
        DB::table('products')->insert([
            'category_id'=>1,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>1,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>1,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>3,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>3,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>3,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>4,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>4,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>4,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>5,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>5,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);
        DB::table('products')->insert([
            'category_id'=>5,
            'product_name'=>Str::random(10),
            'product_description'=>Str::random(10),
            'product_image'=>'default_product_image.jpg',
            'price_new'=>mt_rand(0, 99),
            'price_working_a'=>mt_rand(0, 99),
            'price_working_b'=>mt_rand(0, 99),
            'price_working_c'=>mt_rand(0, 99),
            'price_faulty'=>mt_rand(0, 99),
            'price_damaged'=>mt_rand(0, 99),
        ]);

    }
}
