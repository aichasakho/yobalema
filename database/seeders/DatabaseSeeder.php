<?php

namespace Database\Seeders;

// let use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory()->create([
            'nom' => 'admin',
            'prenom' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('passer123'),
            'remember_token' => Str::random(10),
            'telephone' => "77 990 00 00",
            'adresse' => 'Dakar'
        ]);

        \App\Models\User::factory(20)->create();

    }
}
