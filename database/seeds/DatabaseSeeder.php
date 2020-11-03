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
            'sales_models'=>true,
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

        //Quarantine
        //Quarantine bay 1

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 1',
            'bay_description'=>'FIMP',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-5',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-6',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-7',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-8',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-9',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-10',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-11',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>1,
            'reffs_name'=>'FIMP-12',
        ]);

        //Quarantine Bay 2

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 2',
            'bay_description'=>'Google Lock',
            'number_of_reffs'=>5
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>2,
            'reffs_name'=>'GOCK-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>2,
            'reffs_name'=>'GOCK-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>2,
            'reffs_name'=>'GOCK-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>2,
            'reffs_name'=>'GOCK-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>2,
            'reffs_name'=>'GOCK-5',
        ]);

        //Quarantine Bay 3

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 3',
            'bay_description'=>'Wrong Phone',
            'number_of_reffs'=>5
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>3,
            'reffs_name'=>'WRPH-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>3,
            'reffs_name'=>'WRPH-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>3,
            'reffs_name'=>'WRPH-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>3,
            'reffs_name'=>'WRPH-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>3,
            'reffs_name'=>'WRPH-5',
        ]);

        //Quarantine Bay 4

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 4',
            'bay_description'=>'Device Missing',
            'number_of_reffs'=>5
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>4,
            'reffs_name'=>'DEMI-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>4,
            'reffs_name'=>'DEMI-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>4,
            'reffs_name'=>'DEMI-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>4,
            'reffs_name'=>'DEMI-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>4,
            'reffs_name'=>'DEMI-5',
        ]);

        //Quarantine Bay 5

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 5',
            'bay_description'=>'Blacklisted',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-5',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-6',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-7',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-8',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-9',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-10',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-11',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>5,
            'reffs_name'=>'BLCK-12',
        ]);

        //Quarantine Bay 6

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 6',
            'bay_description'=>'Pin Lock',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-5',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-6',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-7',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-8',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-9',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-10',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-11',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>6,
            'reffs_name'=>'PIN-12',
        ]);

        //Quarantine Bay 7

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 7',
            'bay_description'=>'Downgraded',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-1',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-2',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-3',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-4',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-5',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-6',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-7',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-8',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-9',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-10',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-11',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>7,
            'reffs_name'=>'DOWN-12',
        ]);

        //Quarantine Bay 8

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 8',
            'bay_description'=>'Downgraded',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-13',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-14',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-15',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-16',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-17',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-18',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-19',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-20',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-21',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-22',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-23',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>8,
            'reffs_name'=>'DOWN-24',
        ]);

        //Quarantine Bay 9

        DB::table('quarantine_bays')->insert([
            'bay_name'=>'Bay 9',
            'bay_description'=>'Downgraded',
            'number_of_reffs'=>12
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-25',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-26',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-27',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-28',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-29',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-30',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-31',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-32',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-33',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-34',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-35',
        ]);

        DB::table('quarantine_reffs')->insert([
            'bay_id'=>9,
            'reffs_name'=>'DOWN-36',
        ]);


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
        ]);

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
