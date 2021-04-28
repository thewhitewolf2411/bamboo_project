<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrolleyTrayBinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //receiving trolleys

        DB::table('trolleys')->insert([

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

            'tray_name'=>'TA01-2-B-Plus',
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

            'tray_name'=>'TA02-3',
            'tray_type'=>'T',
            'tray_brand'=>'A',
            'tray_grade'=>'E',
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

            'tray_name'=>'TS01-2-B-Plus',
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

            'tray_name'=>'TS02-3',
            'tray_type'=>'T',
            'tray_brand'=>'S',
            'tray_grade'=>'E',
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

            'tray_name'=>'TH01-2-B-Plus',
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

            'tray_name'=>'TH02-3',
            'tray_type'=>'T',
            'tray_brand'=>'H',
            'tray_grade'=>'E',
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

            'tray_name'=>'TM01-2-B-Plus',
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

            'tray_name'=>'TM02-3',
            'tray_type'=>'T',
            'tray_brand'=>'M',
            'tray_grade'=>'E',
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

        ]);


        //bins
        DB::table('trays')->insert([
            'tray_name'=>'FMIP-1',
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
    }
}
