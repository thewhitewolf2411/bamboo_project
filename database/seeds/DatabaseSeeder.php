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
            'customer_care'=>true,
            'order_management'=>true,
            'create_order'=>true,
            'customer_accounts'=>true,
            'administration'=>true,
            'salvage_models'=>true,
            'feeds'=>true,
            'users'=>true,
            'reports'=>true,
            'cms'=>true,
            'categories'=>true,
            'settings'=>true,
            'payments'=>true,
            'payments_awaiting_assignment'=>true,
            'pending_payments'=>true,
            'completed_payment'=>true,
            'payment_report'=>true
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

        DB::table('trolleys')->insert([

            'trolley_name'=>'RA01',
            'number_of_trays'=>6,
            'trolley_type'=>'Receiving Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RS01',
            'number_of_trays'=>6,
            'trolley_type'=>'Receiving Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RH01',
            'number_of_trays'=>6,
            'trolley_type'=>'Receiving Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RM01',
            'number_of_trays'=>6,
            'trolley_type'=>'Receiving Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'RQ01',
            'number_of_trays'=>6,
            'trolley_type'=>'Receiving Trolley'

        ]);

        //receiving trays
        //trolley 1

        DB::table('trays')->insert([

            'tray_name'=>'RA01-1',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-2',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-3',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-4',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-5',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RA01-6',
            'trolley_id'=>1,
            'number_of_devices'=>0,

        ]);

        //trolley 02

        DB::table('trays')->insert([

            'tray_name'=>'RS01-1',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-2',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-3',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-4',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-5',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RS01-6',
            'trolley_id'=>2,
            'number_of_devices'=>0,

        ]);

        //trolley 03

        DB::table('trays')->insert([

            'tray_name'=>'RH01-1',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-2',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-3',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-4',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-5',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RH01-6',
            'trolley_id'=>3,
            'number_of_devices'=>0,

        ]);

        //Trolley 04

        DB::table('trays')->insert([

            'tray_name'=>'RM01-1',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-2',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-3',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-4',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-5',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RM01-6',
            'trolley_id'=>4,
            'number_of_devices'=>0,

        ]);

        //trolley 05

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-1',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-2',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-3',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-4',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-5',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'RQ01-6',
            'trolley_id'=>5,
            'number_of_devices'=>0,

        ]);

        //Testing trolleys

        DB::table('trolleys')->insert([

            'trolley_name'=>'TA01',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TA02',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TS01',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TS02',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TH01',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TH02',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TM01',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TM02',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        DB::table('trolleys')->insert([

            'trolley_name'=>'TQ01',
            'number_of_trays'=>6,
            'trolley_type'=>'Testing Trolley'

        ]);

        //testing trays
        //TA01

        DB::table('trays')->insert([

            'tray_name'=>'TA01-1-A',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-2-B+',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-3-B',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-4-C',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-5-WSI',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA01-6-WDS',
            'trolley_id'=>6,
            'number_of_devices'=>0,

        ]);

        //TA02

        DB::table('trays')->insert([

            'tray_name'=>'TA02-1-NWSI',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-2-NWSD',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-3-CATASTROPHIC',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-4',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-5',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TA02-6',
            'trolley_id'=>7,
            'number_of_devices'=>0,

        ]);

        //TS01

        DB::table('trays')->insert([

            'tray_name'=>'TS01-1-A',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-2-B+',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-3-B',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-4-C',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-5-WSI',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS01-6-WDS',
            'trolley_id'=>8,
            'number_of_devices'=>0,

        ]);

        //TS02

        DB::table('trays')->insert([

            'tray_name'=>'TS02-1-NWSI',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-2-NWSD',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-3-CATASTROPHIC',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-4',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-5',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TS02-6',
            'trolley_id'=>9,
            'number_of_devices'=>0,

        ]);

        //TH01
        DB::table('trays')->insert([

            'tray_name'=>'TH01-1-A',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-2-B+',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-3-B',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-4-C',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-5-WSI',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH01-6-WDS',
            'trolley_id'=>10,
            'number_of_devices'=>0,

        ]);

        //TH02
        DB::table('trays')->insert([

            'tray_name'=>'TH02-1-NWSI',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-2-NWSD',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-3-CATASTROPHIC',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-4',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-5',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TH02-6',
            'trolley_id'=>11,
            'number_of_devices'=>0,

        ]);

        //TM01
        DB::table('trays')->insert([

            'tray_name'=>'TM01-1-A',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-2-B+',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-3-B',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-4-C',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-5-WSI',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM01-6-WDS',
            'trolley_id'=>12,
            'number_of_devices'=>0,

        ]);

        //TM02
        DB::table('trays')->insert([

            'tray_name'=>'TM02-1-NWSI',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-2-NWSD',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-3-CATASTROPHIC',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-4',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-5',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TM02-6',
            'trolley_id'=>13,
            'number_of_devices'=>0,

        ]);

        //TQ01
        DB::table('trays')->insert([

            'tray_name'=>'TQ01-1',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-2',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-3',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-4',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-5',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);

        DB::table('trays')->insert([

            'tray_name'=>'TQ01-6',
            'trolley_id'=>14,
            'number_of_devices'=>0,

        ]);



    }
}
