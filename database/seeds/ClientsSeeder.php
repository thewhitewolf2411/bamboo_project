<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'account_name'=>'Tesla Motors',
            'contact_name'=>'Elon Musk',
            'address'=>'Hethel, UK',
            'post_code'=>'01234',
            'country'=>'USA',
            'contact_email'=>'some@dummy.email',
            'contact_number'=>'1',
            'vat_code'=>'T1',
            'payment_type'=>'Transfer'
        ]);

        DB::table('clients')->insert([
            'account_name'=>'SpaceX',
            'contact_name'=>'Elon Musk',
            'address'=>'Austin,Texas, US',
            'post_code'=>'01234',
            'country'=>'USA',
            'contact_email'=>'some@dummy.email',
            'contact_number'=>'1',
            'vat_code'=>'T1',
            'payment_type'=>'Transfer'
        ]);

        DB::table('clients')->insert([
            'account_name'=>'Nurolink',
            'contact_name'=>'Elon Musk',
            'address'=>'Austin,Texas, US',
            'post_code'=>'01234',
            'country'=>'USA',
            'contact_email'=>'some@dummy.email',
            'contact_number'=>'1',
            'vat_code'=>'T1',
            'payment_type'=>'Transfer'
        ]);
    }
}
