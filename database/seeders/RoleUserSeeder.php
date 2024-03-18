<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /** Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Client',
            'Chauffeur',
            // Ajoutez d'autres rôles selon vos besoins
        ];

        foreach ($roles as $role) {
            // Ajoutez un rôle avec un nom donné
            DB::table('role_users')->insertGetId([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
