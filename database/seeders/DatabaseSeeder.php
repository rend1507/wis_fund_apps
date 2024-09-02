<?php

namespace Database\Seeders;

use App\Models\UserBase;
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

        UserBase::factory()->create([
            'name_user_base' => 'Test User',
            'email_user_base' => 'test@example.com',
        ]);
    }
}
