<?php

use App\Eloquent\RecycleOffer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Crypt as Crypt;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TrolleyTrayBinSeeder::class);
        $this->call(NetworksSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(FAQSeeder::class);
        $this->call(PromotionalDevicesSeeder::class);

        DB::table('additional_costs')->insert([
            'administration_costs'=>0.00,
            'carriage_costs'=>0.00,
            'miscellaneous_costs'=>0.00,
            'per_job_deduction'=>0.00,
            'applied_to'=>0
        ]);

        RecycleOffer::create([
            'device_id' => 35,
            'offer_banner' => 'recycle_offer_home.svg',
            'offer_tablet_banner' => 'recycle_offer_tablet.png',
            'offer_mobile_banner' => 'recycle_offer_mobile.png',
            'offer_selling_banner' => 'recycle_offer_selling_banner.png',
            'offer_selling_tablet_banner' => 'recycle_offer_selling_banner_tablet.png',
            'offer_selling_mobile_banner' => 'recycle_offer_selling_banner_mobile.png',
            'status' => true
        ]);
    }
}
