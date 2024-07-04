<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => 'admin@admin',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Enseignant',
            'email' => 'cesar@cesar',
            'password' => 'cesar@cesar',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Etudiant',
            'email' => 'student@test',
            'password' => 'student@test',
            'role_id' => 3,
        ]);
    }
}
