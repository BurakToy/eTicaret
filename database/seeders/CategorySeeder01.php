<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder01 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::create([
            'id'=>'1',
            'parent_id'=>null,
            'name'=>'bilgisayar',
            'slug'=>'bilgisayar',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'2',
            'parent_id'=>null,
            'name'=>'telefon',
            'slug'=>'telefon',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'3',
            'parent_id'=>null,
            'name'=>'tablet',
            'slug'=>'tablet',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'4',
            'parent_id'=>'1',
            'name'=>'laptop',
            'slug'=>'laptop',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'5',
            'parent_id'=>'1',
            'name'=>'masaüstü',
            'slug'=>'masaüstü',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'6',
            'parent_id'=>'2',
            'name'=>'akıllı telefon',
            'slug'=>'akıllı telefon',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
        category::create([
            'id'=>'7',
            'parent_id'=>'2',
            'name'=>'Katlanabilir Telefon',
            'slug'=>'Katlanabilir Telefon',
            'sort_order'=>'1',
            'is_active'=>'1',
        ]);
    }
}
