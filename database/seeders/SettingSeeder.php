<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::factory()->create(
            [
                'setting_type_id' => 1,
                'name' => 'General',
                'description' => 'This settings includes general settings',
                'status' => true,
            ]
        );
        \App\Models\Setting::factory()->create(
            [
                'setting_type_id' => 2,
                'name' => 'General',
                'description' => 'This settings includes panel settings',
                'status' => true,
            ]
        );
        \App\Models\Setting::factory()->create(
            [
                'setting_type_id' => 3,
                'name' => 'General',
                'description' => 'This settings includes app settings',
                'status' => true,
            ]
        );
    }
}
