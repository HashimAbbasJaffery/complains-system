<?php

namespace Database\Seeders;

use App\Models\Complain;
use App\Models\ComplainType;
use App\Models\Question;
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
        $total = 10;
        ComplainType::factory($total)->create();
        Question::factory($total)->create();
        User::factory($total)->create();
        Complain::factory($total)->create();
    }
}
