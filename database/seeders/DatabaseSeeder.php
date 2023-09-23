<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => env("PANEL_DEFAULT_USER_NAME"),
            'email' => env("PANEL_DEFAULT_USER_EMAIL"),
            'password' =>  Hash::make(env("PANEL_DEFAULT_USER_PASSWORD"))
        ]);
    }
}
