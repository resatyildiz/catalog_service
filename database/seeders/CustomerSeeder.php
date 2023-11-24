<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Customer::factory()->create([
            'name' => "Misafir Kullanıcı",
            'first_name' => "Misafir",
            'last_name' => "Kullanıcı",
            'email' => "misafir@unknowemail.com",
            'phone' => "905000000000",
        ]);
    }
}
