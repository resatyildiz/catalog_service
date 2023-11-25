<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Dine In',
            'slug' => 'dine-in',
            'status' => true,
            'sale_channel_type_id' => 1,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Take Away',
            'slug' => 'take-away',
            'status' => true,
            'sale_channel_type_id' => 1,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Delivery',
            'slug' => 'delivery',
            'status' => true,
            'sale_channel_type_id' => 1,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Getir',
            'slug' => 'getir',
            'status' => false,
            'sale_channel_type_id' => 2,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Yemek Sepeti',
            'slug' => 'yemek-sepeti',
            'status' => false,
            'sale_channel_type_id' => 2,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Migros Yemek',
            'slug' => 'migros-yemek',
            'status' => false,
            'sale_channel_type_id' => 2,
        ]);
        \App\Models\SaleChannel::factory()->create([
            'name' => 'Trendyol Yemek',
            'slug' => 'trendyol-yemek',
            'status' => false,
            'sale_channel_type_id' => 2,
        ]);

        $this->command->info('Sale channels seeded!');
    }
}
