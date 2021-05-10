<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // product category
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


        // product brands
        DB::table('brand')->insert([
            'brand_name'=>'Apple',
            // 'brand_image'=>'Image 13_1597675760.png',
            'brand_image'=>'apple.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Samsung',
            // 'brand_image'=>'Image 14_1597675775.png',
            'brand_image'=>'samsung.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Huawei',
            //'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'huawei.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Google',
            // 'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'google.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'LG',
            //'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'lg.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Motorola',
            // 'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'motorola.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Nokia',
            //'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'nokia.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'OnePlus',
            //'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'oneplus.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Oppo',
            //'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'oppo.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Sony',
            // 'brand_image'=>'/Image 15_1597675746.png',
            'brand_image'=>'sony.svg',
            'total_produts'=>0
        ]);

        DB::table('brand')->insert([
            'brand_name'=>'Xiaomi',
            'brand_image'=>'xiaomi.svg',
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
    }
}
