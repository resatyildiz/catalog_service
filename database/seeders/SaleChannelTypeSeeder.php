<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleChannelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SaleChannelType::factory()->create([
            "name" => "InApp",
        ]);
        \App\Models\SaleChannelType::factory()->create([
            "name" => "ThirdParty",
        ]);
    }
}
