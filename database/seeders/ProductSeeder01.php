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
           'vat_rate'=>'99',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'1',
           'is_bestseller'=>'1',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]); product::create([
            'id'=>'2',
            'category_id'=>'1',
            'sku'=>'2',
            'name'=>'testBilg2',
            'slug'=>'slugtestBilg2',
           'short_description'=>'short_descriptiontestBilg2',
           'long_description'=>'long_descriptiontestBilg2',
           'price'=>'100',
           'discount_price'=>'27',
           'vat_rate'=>'100',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'1',
           'is_bestseller'=>'1',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]); product::create([
            'id'=>'3',
            'category_id'=>'2',
            'sku'=>'3',
            'name'=>'testBilg3',
            'slug'=>'slugtestBilg3',
           'short_description'=>'short_descriptiontestBilg3',
           'long_description'=>'long_descriptiontestBilg3',
           'price'=>'100',
           'discount_price'=>'43',
           'vat_rate'=>'100',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'0',
           'is_bestseller'=>'1',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]); product::create([
            'id'=>'4',
            'category_id'=>'1',
            'sku'=>'4',
            'name'=>'testBilg4',
            'slug'=>'slugtestBilg4',
           'short_description'=>'short_descriptiontestBilg4',
           'long_description'=>'long_descriptiontestBilg4',
           'price'=>'100',
           'discount_price'=>'20',
           'vat_rate'=>'100',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'0',
           'is_bestseller'=>'0',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]);product::create([
            'id'=>'5',
            'category_id'=>'1',
            'sku'=>'5',
            'name'=>'testBilg5',
            'slug'=>'slugtestBilg5',
           'short_description'=>'short_descriptiontestBilg5',
           'long_description'=>'long_descriptiontestBilg5',
           'price'=>'100',
           'discount_price'=>'20',
           'vat_rate'=>'100',
           'status'=>'draft',
           'has_variants'=>'1',
           'is_new'=>'0',
           'is_bestseller'=>'0',
           'is_featured'=>'1',
           'is_campaign'=>'1',
        ]);

    }
}
