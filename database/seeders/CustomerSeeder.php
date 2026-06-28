<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Reza',
            'mobile' => '09176123456',
        ]);
        Customer::create([
            'name' => 'AbolFazl',
            'mobile' => '09966123456',
        ]);
        Customer::create([
            'name' => 'Fatemeh',
            'mobile' => '09376126543',
        ]);
        Customer::create([
            'name' => 'Yegane',
            'mobile' => '09076128523',
        ]);
    }
}
