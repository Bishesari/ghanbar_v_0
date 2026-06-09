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
        Product::craete([
            'name' => 'ماست',
            'description' => 'ماست پروبیوتیک 900 گرمی سطلی',
        ]);
        Product::craete([
            'name' => 'ماست',
            'description' => 'ماست پروبیوتیک 500 گرمی',
        ]);
        Product::craete([
            'name' => 'پنیر',
            'description' => 'پنیر سفید ایرانی مخصوص قنبر 200 گرمی',
        ]);

        Product::craete([
            'name' => 'پنیر',
            'description' => 'پنیر گردویی 150 گرمی',
        ]);

        Product::create([
            'name' => 'دوغ',
            'description' => 'دوغ گازدار 1 لیتری',
        ]);
    }
}
