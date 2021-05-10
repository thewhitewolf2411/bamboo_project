<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
