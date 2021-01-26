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
            'user_id'=>1,
            'recycle'=>true,
            'trade_pack_despatch'=>true,
            'awaiting_receipt'=>true,
            'receiving'=>true,
            'device_testing'=>true,
            'trolley_management'=>true,
            'trays_managment'=>true,
            'box_management'=>true,
            'quarantine_managment'=>true,
            'warehouse_management'=>true,
            'buying'=>true,
            'ecommerence_orders'=>true,
            'ecommerence_users'=>true,
            'selling_status'=>true,
            'ecommerence_create_order'=>true,
            'customer_care'=>true,
            'order_management'=>true,
            'create_order'=>true,
            'customer_accounts'=>true,
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
            'failed_payments'=>true
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
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Samsung',
            'brand_image'=>'Image 14_1597675775.png',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Huawei',
            'brand_image'=>'/Image 15_1597675746.png',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Google',
            'brand_image'=>'Image 16_1597675717.png',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Oneplus',
            'brand_image'=>'Image 16_1597675717.png',
            'total_produts'=>0
        ]);

        //Default conditions
        DB::table('conditions')->insert([
            'name'=>'A',
            'alias'=>'A',
            'importance'=>100
        ]);

        DB::table('conditions')->insert([
            'name'=>'B+',
            'alias'=>'B+',
            'importance'=>80
        ]);

        DB::table('conditions')->insert([
            'name'=>'B',
            'alias'=>'B',
            'importance'=>60
        ]);

        DB::table('conditions')->insert([
            'name'=>'C',
            'alias'=>'C',
            'importance'=>40
        ]);

        DB::table('conditions')->insert([
            'name'=>'WSI',
            'alias'=>'WSI',
            'importance'=>20
        ]);

        DB::table('conditions')->insert([
            'name'=>'WSD',
            'alias'=>'WSD',
            'importance'=>20
        ]);

        DB::table('conditions')->insert([
            'name'=>'NWSI',
            'alias'=>'NWSI',
            'importance'=>20
        ]);

        DB::table('conditions')->insert([
            'name'=>'NWSD',
            'alias'=>'NWSD',
            'importance'=>20
        ]);

        DB::table('conditions')->insert([
            'name'=>'PND',
            'alias'=>'PND',
            'importance'=>20
        ]);

        DB::table('conditions')->insert([
            'name'=>'Catastrophic',
            'alias'=>'Catastrophic',
            'importance'=>10
        ]);

        //receiving trolleys

        /*DB::table('trolleys')->insert([

            'trolley_name'=>'RA01',
            'trolley_type'=>'R',
            'trolley_brand'=>'A',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RS01',
            'trolley_type'=>'R',
            'trolley_brand'=>'S',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RH01',
            'trolley_type'=>'R',
            'trolley_brand'=>'H',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RM01',
            'trolley_type'=>'R',
            'trolley_brand'=>'M',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RQ01',
            'trolley_type'=>'R',
            'trolley_brand'=>'Q',
            'number_of_trays'=>6,

        ]);

        //receiving trays
        //trolley 1

        DB::table('trays')->insert([

            'tray_name'=>'RA01-1',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-2',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-3',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-4',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-5',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-6',
            'tray_type'=>'R',
            'tray_brand'=>'A',
            'tray_grade'=>'0',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        //trolley 02

        DB::table('trays')->insert([

            'tray_name'=>'RS01-1',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-2',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-3',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-4',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-5',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-6',
            'tray_type'=>'R',
            'tray_brand'=>'S',
            'tray_grade'=>'0',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        //trolley 03

        DB::table('trays')->insert([

            'tray_name'=>'RH01-1',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-2',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-3',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-4',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-5',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-6',
            'tray_type'=>'R',
            'tray_brand'=>'H',
            'tray_grade'=>'0',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        //Trolley 04

        DB::table('trays')->insert([

            'tray_name'=>'RM01-1',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-2',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-3',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-4',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-5',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-6',
            'tray_type'=>'R',
            'tray_brand'=>'M',
            'tray_grade'=>'0',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        //trolley 05

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-1',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-2',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-3',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-4',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-5',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-6',
            'tray_type'=>'R',
            'tray_brand'=>'Q',
            'tray_grade'=>'0',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        //Testing trolleys

        DB::table('trolleys')->insert([

            'trolley_name'=>'TA01',
            'trolley_type'=>'T',
            'trolley_brand'=>'A',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TA02',
            'trolley_type'=>'T',
            'trolley_brand'=>'A',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TS01',
            'trolley_type'=>'T',
            'trolley_brand'=>'S',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TS02',
            'trolley_type'=>'T',
            'trolley_brand'=>'S',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TH01',
            'trolley_type'=>'T',
            'trolley_brand'=>'H',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TH02',
            'trolley_type'=>'T',
            'trolley_brand'=>'H',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TM01',
            'trolley_type'=>'T',
            'trolley_brand'=>'M',
            'number_of_trays'=>6,
            

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TM02',
            'trolley_type'=>'T',
            'trolley_brand'=>'M',
            'number_of_trays'=>6,

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TQ01',
            'trolley_type'=>'T',
            'trolley_brand'=>'Q',
            'number_of_trays'=>6,

        ]);

        //testing trays
        //TA01

        DB::table('trays')->insert([

            'tray_name'=>'TA01-1-A',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'A',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-2-B+',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'B+',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-3-B',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'B',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-4-C',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'C',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-5-WSI',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'WSI',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-6-WSD',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'WSD',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        //TA02

        DB::table('trays')->insert([

            'tray_name'=>'TA02-1-NWSI',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'NWSI',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-2-NWSD',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'NWSD',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-3-CATASTROPHIC',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'CAT',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-4',
            'trolley_id'=>7,
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'E',
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-5',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'E',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-6',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'E',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        //TS01

        DB::table('trays')->insert([

            'tray_name'=>'TS01-1-A',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'A',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-2-B+',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'B+',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-3-B',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'B',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-4-C',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'C',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-5-WSI',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'WSI',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-6-WSD',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'WSD',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        //TS02

        DB::table('trays')->insert([

            'tray_name'=>'TS02-1-NWSI',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'NWSI',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-2-NWSD',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'NWSD',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-3-CATASTROPHIC',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'CAT',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-4',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'E',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-5',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'E',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-6',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'E',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        //TH01
        DB::table('trays')->insert([

            'tray_name'=>'TH01-1-A',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'A',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-2-B+',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'B+',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-3-B',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'B',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-4-C',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'C',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-5-WSI',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'WSI',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-6-WSD',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'WSD',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        //TH02
        DB::table('trays')->insert([

            'tray_name'=>'TH02-1-NWSI',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'NWSI',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-2-NWSD',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'NWSD',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-3-CATASTROPHIC',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'CAT',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-4',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'E',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-5',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'E',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-6',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'E',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        //TM01
        DB::table('trays')->insert([

            'tray_name'=>'TM01-1-A',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'A',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-2-B+',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'B+',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-3-B',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'B',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-4-C',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'C',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-5-WSI',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'WSI',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-6-WSD',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'WSD',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        //TM02
        DB::table('trays')->insert([

            'tray_name'=>'TM02-1-NWSI',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'NWSI',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-2-NWSD',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'NWSD',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-3-CATASTROPHIC',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'CAT',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-4',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'E',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-5',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'E',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-6',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'E',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        //TQ01
        DB::table('trays')->insert([

            'tray_name'=>'TQ01-1',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-2',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-3',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-4',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-5',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-6',
            'tray_type'=>'T',
            'tray_brand'=>'Q',
            'tray_grade'=>'Q',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);*/


        //bins
        DB::table('trays')->insert([
            'tray_name'=>'FIMP-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'FIMP',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'GOCK-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'GOCK',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'WRPH-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'WRPH',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'DEMI-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'DEMI',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'BLCK-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'BLCK',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'PIN-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'PIN',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        DB::table('trays')->insert([
            'tray_name'=>'DOWN-1',
            'tray_type'=>'B',
            'tray_brand'=>'Q',
            'tray_grade'=>'DOWN',
            'trolley_id'=>null,
            'number_of_devices'=>0,
            'max_number_of_devices'=>30,
        ]);
        /*
        //boxes
        //apple
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(A) AP01',
            'description'=>'Grade A',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(B+) AP01',
            'description'=>'Grade B+',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(B) AP01',
            'description'=>'Grade B',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(C) AP01',
            'description'=>'Grade C',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(WSI) AP01',
            'description'=>'Grade WSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(WSD) AP01',
            'description'=>'Grade WSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(NWSI) AP01',
            'description'=>'Grade NWSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(NWSD) AP01',
            'description'=>'Grade NWSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(CAT) AP01',
            'description'=>'Grade catastrophic',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(FIMP) AP01',
            'description'=>'FIMP Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(SICK) AP01',
            'description'=>'SIM Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(TAB) AP01',
            'description'=>'Tablet mixed grades',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Apple',
            'box_name'=>'(SM) AP01',
            'description'=>'Smart Watches mixed grades',
        ]);

        //samsung
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(A) SA01',
            'description'=>'Grade A',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(B+) SA01',
            'description'=>'Grade B+',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(B) SA01',
            'description'=>'Grade B',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(C) SA01',
            'description'=>'Grade C',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(WSI) SA01',
            'description'=>'Grade WSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(WSD) SA01',
            'description'=>'Grade WSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(NWSI) SA01',
            'description'=>'Grade NWSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(NWSD) SA01',
            'description'=>'Grade NWSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(CAT) SA01',
            'description'=>'Grade catastrophic',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(GOCK) SA01',
            'description'=>'Google Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(SICK) SA01',
            'description'=>'SIM Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(TAB) SA01',
            'description'=>'Tablets mixed grades',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Samsung',
            'box_name'=>'(SW) SA01',
            'description'=>'Smart Watches mixed grades',
        ]);

        //Huawei
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(A) HU01',
            'description'=>'Grade A',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(B+) HU01',
            'description'=>'Grade B+',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(B) HU01',
            'description'=>'Grade B',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(C) HU01',
            'description'=>'Grade C',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(WSI) HU01',
            'description'=>'Grade WSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(WSD) HU01',
            'description'=>'Grade WSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(NWSI) HU01',
            'description'=>'Grade NWSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(NWSD) HU01',
            'description'=>'Grade NWSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(CAT) HU01',
            'description'=>'Grade catastrophic',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(GOCK) HU01',
            'description'=>'Google Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(SICK) HU01',
            'description'=>'SIM Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(TAB) HU01',
            'description'=>'Tablets mixed grades',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Huawei',
            'box_name'=>'(SW) HU01',
            'description'=>'Smart Watches mixed grades',
        ]);

        //Miscenalious
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(A) MI01',
            'description'=>'Grade A',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(B+) MI01',
            'description'=>'Grade B+',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(B) MI01',
            'description'=>'Grade B',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(C) MI01',
            'description'=>'Grade C',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(WSI) MI01',
            'description'=>'Grade WSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(WSD) MI01',
            'description'=>'Grade WSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(NWSI) MI01',
            'description'=>'Grade NWSI',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(NWSD) MI01',
            'description'=>'Grade MWSD',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(CAT) MI01',
            'description'=>'Grade catastrophic',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(GOCK) MI01',
            'description'=>'Google Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(SICK) MI01',
            'description'=>'SIM Locked devices',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(TAB) MI01',
            'description'=>'Tablets mixed grades',
        ]);
        DB::table('boxes')->insert([
            'manifacturer'=>'Miscenalious',
            'box_name'=>'(SW) MI01',
            'description'=>'Smart Watches mixed grades',
        ]);*/

        DB::table('networks')->insert([
            'network_name'=>'o2',
            'network_image'=>'/networks/o2.png'
        ]);
        DB::table('networks')->insert([
            'network_name'=>'ee',
            'network_image'=>'/networks/ee.png'
        ]);
        DB::table('networks')->insert([
            'network_name'=>'vodafone',
            'network_image'=>'/networks/vodafone.png'
        ]);
        DB::table('networks')->insert([
            'network_name'=>'3',
            'network_image'=>'/networks/3.png'
        ]);
        DB::table('networks')->insert([
            'network_name'=>'unlocked',
            'network_image'=>'/networks/unlocked.png'
        ]);
    }
}
