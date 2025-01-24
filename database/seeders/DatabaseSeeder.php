<?php

namespace Database\Seeders;

use App\Models\Complain;
use App\Models\ComplainType;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        ComplainType::factory(50)->create();
        // Complain::factory(50)->create();
    }
}
