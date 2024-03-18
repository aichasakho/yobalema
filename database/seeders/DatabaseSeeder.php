<?php

namespace Database\Seeders;

// let use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Voiture;
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
        $this->call([
            RoleUserSeeder::class,
        ]);


        User::factory()->create([
            'nom' => 'admin',
            'prenom' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('passer'),
            'remember_token' => Str::random(10),
            'telephone' => "77 770 70 70",
            'adresse' => 'Dakar'
        ]);

        User::factory(10)->create();

        //Voiture::factory(10)->create();



    }
}
