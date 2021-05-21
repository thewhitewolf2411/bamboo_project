<?php

use Illuminate\Database\Seeder;

class PromotionalDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotional_devices')->insert([
            'promo_type'=>1,
            'device_1'=>null,
            'device_2'=>null,
            'device_3'=>null,
            'device_4'=>null,
        ]);

        DB::table('promotional_devices')->insert([
            'promo_type'=>2,
            'device_1'=>null,
            'device_2'=>null,
            'device_3'=>null,
            'device_4'=>null,
        ]);

        DB::table('promotional_devices')->insert([
            'promo_type'=>2,
            'device_1'=>null,
            'device_2'=>null,
            'device_3'=>null,
            'device_4'=>null,
        ]);

        DB::table('promotional_devices')->insert([
            'promo_type'=>2,
            'device_1'=>null,
            'device_2'=>null,
            'device_3'=>null,
            'device_4'=>null,
        ]);
    }
}
