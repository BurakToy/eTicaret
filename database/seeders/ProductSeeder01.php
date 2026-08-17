<?php

namespace Database\Seeders;


use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder01 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       product::create([
            'id'=>'1',
            'category_id'=>'1',
            'sku'=>'1',
            'name'=>'testBilg1',
            'slug'=>'slugtestBilg1',
           'short_description'=>'short_descriptiontestBilg1',
           'long_description'=>'long_descriptiontestBilg1',
           'price'=>'100',
           'discount_price'=>'100',
           'vat_rate'=>'100',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'1',
           'is_bestseller'=>'1',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]);
    }
}
