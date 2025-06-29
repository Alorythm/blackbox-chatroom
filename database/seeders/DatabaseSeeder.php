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

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at'  => now(),
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
            'email_verified_at'  => now(),
            'is_moderator' => true
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at'  => now()
        ]);
    }
}
