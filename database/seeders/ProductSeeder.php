<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'ماست',
            'description' => 'ماست پروبیوتیک 900 گرمی سطلی',
        ]);
        Product::create([
            'name' => 'ماست',
            'description' => 'ماست پروبیوتیک 500 گرمی',
        ]);
        Product::create([
            'name' => 'پنیر',
            'description' => 'پنیر سفید ایرانی مخصوص قنبر 200 گرمی',
        ]);

        Product::create([
            'name' => 'پنیر',
            'description' => 'پنیر گردویی 150 گرمی',
        ]);

        Product::create([
            'name' => 'دوغ',
            'description' => 'دوغ گازدار 1 لیتری',
        ]);

    }
}
