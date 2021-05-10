<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Crypt as Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //users
         DB::table('users')->insert([

            'first_name'=>'bamboo',
            'last_name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Crypt::encrypt('E6LK1b51JzQGBv86eVWp'),
            'current_phone'=>'3',
            'preffered_os'=>'Android',
            'sub'=>false,
            'username'=>'bambooadmin',
            'delivery_address'=>'The Parsonage, 1 Halmer Gate, Spalding, PE11 2DR',
            'billing_address'=>'32 Hammonds Drive, Peterborough, PE1 5AA',
            'contact_number'=>'061172442',
            'type_of_user'=>3,
            'account_disabled'=>false,
            'birth_date' => '2020-01-10 00:00:00'
        ]);

        DB::table('users')->insert([

            'first_name'=>'Eren',
            'last_name'=>'Yeager',
            'email'=>'eren@yeager.com',
            'password'=>Crypt::encrypt('Lambda12'),
            'current_phone'=>'2',
            'preffered_os'=>'iOS',
            'sub'=>false,
            'username'=>'eyeager',
            'delivery_address'=>'The Works, 414 Union Street, Aberdeen, AB10 1TQ',
            'billing_address'=>'Widapa Ltd, 25 Second Drove, Peterborough, PE1 5XA',
            'contact_number'=>'061172442',
            'type_of_user'=>0,
            'account_disabled'=>false,
            'birth_date' => '2020-01-10 00:00:00'
        ]);

        DB::table('portal_users')->insert([
            'user_id'=>1,
            'recycle'=>true,
            'trade_pack_despatch'=>true,
            'awaiting_receipt'=>true,
            'receiving'=>true,
            'device_testing'=>true,
            'trolley_management'=>true,
            'trays_managment'=>true,
            'quarantine_managment'=>true,
            'warehouse_management'=>true,
            'sales_lots'=>true,
            'despatch'=>true,
            'buying'=>true,
            'ecommerence_orders'=>true,
            'ecommerence_users'=>true,
            'selling_status'=>true,
            'ecommerence_create_order'=>true,
            'customer_care'=>true,
            'order_management'=>true,
            'create_order'=>true,
            'customer_accounts'=>true,
            'messages'=>true,
            'administration'=>true,
            'salvage_models'=>true,
            'sales_models'=>true,
            'feeds'=>true,
            'users'=>true,
            'reports'=>true,
            'cms'=>true,
            'categories'=>true,
            'settings'=>true,
            'payments'=>true,
            'awaiting_payments'=>true,
            'submit_payments'=>true,
            'payment_confirmations'=>true,
            'failed_payments'=>true,
            'recycle_offers'=>true,
            'despatch'=>true
        ]);
    }
}
