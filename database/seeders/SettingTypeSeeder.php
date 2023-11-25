<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SettingType::factory()->create(
            [
                'name' => 'General',
                'description' => 'General settings',
                'status' => true,
            ]
        );
        \App\Models\SettingType::factory()->create(
            [
                'name' => 'Panel',
                'description' => 'Panel settings',
                'status' => true,
            ]
        );
        \App\Models\SettingType::factory()->create(
            [
                'name' => 'App',
                'description' => 'App settings',
                'status' => true,
            ]
        );
    }
}
