<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Museum',
            'email' => 'admin@test.kz',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Editor Museum',
            'email' => 'editor@test.kz',
            'password' => 'password',
            'role' => 'editor',
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@test.kz',
            'password' => 'password',
            'role' => 'user',
        ]);
    }
}
