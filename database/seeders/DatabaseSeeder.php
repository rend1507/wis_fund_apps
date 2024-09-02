<?php

namespace Database\Seeders;

use App\Models\UserBasic;
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

        UserBasic::factory()->create([
            'name_user_basic' => 'Test User',
            'email_user_basic' => 'test@example.com',
        ]);
    }
}
