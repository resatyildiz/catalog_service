<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleChannelItemGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SaleChannelItemGroup::factory()->create([
            'name' => 'Default',
        ]);

        $this->command->info('Sale channel item groups seeded!');
    }
}
