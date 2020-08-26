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

        DB::table('users')->insert([

            'first_name'=>'Eren',
            'last_name'=>'Yeager',
            'email'=>'eren@yeager.com',
            'password'=>Hash::make('Lambda12'),
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
        ]);

    }
}
