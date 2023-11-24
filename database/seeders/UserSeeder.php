<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => env("PANEL_DEFAULT_USER_NAME"),
            'email' => env("PANEL_DEFAULT_USER_EMAIL"),
            'password' =>  Hash::make(env("PANEL_DEFAULT_USER_PASSWORD"))
        ]);
    }
}
