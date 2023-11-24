<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\OrderItemStatus::factory()->create(
            [
                'name' => "Oluşturuldu",
                'slug' => "created",
            ]
        );
        \App\Models\OrderItemStatus::factory()->create(
            [
                'name' => "Hazırlanıyor",
                'slug' => "preparing",
            ]
        );

        \App\Models\OrderItemStatus::factory()->create(
            [
                'name' => "Tamamlandı",
                'slug' => "completed",
            ]
        );

        \App\Models\OrderItemStatus::factory()->create(
            [
                'name' => "İptal Edildi",
                'slug' => "canceled",
            ]
        );

    }
}
