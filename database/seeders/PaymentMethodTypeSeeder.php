<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethodTypes = [
            [
                'name' => 'Nakit',
                'slug' => 'cash',
            ],
            [
                'name' => 'Kredi Kartı',
                'slug' => 'credit-card',
            ],
            [
                'name' => 'Debit Card',
                'slug' => 'debit-card',
            ],
            [
                'name' => 'Multinet',
                'slug' => 'multinet',
            ],
            [
                'name' => 'Ticket(Edenred)',
                'slug' => 'ticket',
            ],
            [
                'name' => 'Sodexo',
                'slug' => 'sodexo',
            ],
            [
                'name' => 'Setcard',
                'slug' => 'setcard',
            ],
        ];

        foreach ($paymentMethodTypes as $paymentMethodType) {
            \App\Models\PaymentMethodType::factory()->create($paymentMethodType);
        }
    }
}
