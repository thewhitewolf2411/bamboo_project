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
        ]);

        DB::table('testing_questions')->insert([

            'question'=>'IMEI verification',
            'answer_1'=>'IMEI match',
            'answer_2'=>'IMEI mismatch',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Model',
            'answer_1'=>'Correct',
            'answer_2'=>'Incorrect',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Colour',
            'answer_1'=>'Correct',
            'answer_2'=>'Incorrect',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Checkmend verification',
            'answer_1'=>'Clear',
            'answer_2'=>'Blocked',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Missing/Fake parts?',
            'answer_1'=>'Yes',
            'answer_2'=>'No',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Device Fully functional?',
            'answer_1'=>'Yes',
            'answer_2'=>'No',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Signs of water damage?',
            'answer_1'=>'Yes',
            'answer_2'=>'No',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'FMIP/Google Lock?',
            'answer_1'=>'Yes',
            'answer_2'=>'No',

        ]);

        DB::table('testing_questions')->insert([

            'question'=>'Pin lock/Password lock?',
            'answer_1'=>'Yes',
            'answer_2'=>'No',

        ]);

    }
}
