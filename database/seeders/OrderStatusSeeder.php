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

        $seedData = [
            [
                'name' => "Sipariş Alındı",
                'slug' => "received",
            ],
            [
                'name' => "Sipariş Tamamlandı",
                'slug' => "completed",

            ],
            [
                'name' => "Sipariş İptal Edildi",
                'slug' => "canceled",
            ],
            [
                'name' => "Sipariş Hazırlanıyor",
                'slug' => "processing",
            ],
            [
                'name' => "Sipariş Hazırlandı",
                'slug' => "prepared",
            ],
            [
                'name' => "Sipariş Teslim Edildi",
                'slug' => "delivered",
            ],
            [
                'name' => "Kısmi Ödeme Alındı",
                'slug' => "partial_payment_received",
            ],
            [
                'name' => "Ödeme Alındı",
                'slug' => "payment_received",
            ],
        ];

        foreach ($seedData as $data) {
            \App\Models\OrderStatus::create($data);
        }
    }
}
