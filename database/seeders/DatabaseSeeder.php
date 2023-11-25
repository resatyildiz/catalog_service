<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                UserSeeder::class,
                CustomerSeeder::class,
                OrderStatusSeeder::class,
                OrderItemStatusSeeder::class,
                SaleChannelTypeSeeder::class,
                SaleChannelSeeder::class,
                SaleChannelItemGroupSeeder::class,
                SettingTypeSeeder::class
            ]
        );
    }
}
