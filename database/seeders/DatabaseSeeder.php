<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\License;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LicenseSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            QuestionSeeder::class,
            NewsSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
