<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş Alındı",
                'slug' => "received",
            ]
        );
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş Tamamlandı",
                'slug' => "completed",

            ]
        );
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş İptal Edildi",
                'slug' => "canceled",
            ]
        );
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş Hazırlanıyor",
                'slug' => "processing",
            ]
        );
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş Hazırlandı",
                'slug' => "prepared",
            ]
        );
        \App\Models\OrderStatus::factory()->create(
            [
                'name' => "Sipariş Teslim Edildi",
                'slug' => "delivered",
            ]
        );
    }
}
