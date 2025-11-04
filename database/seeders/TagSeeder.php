<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag_names = ['creature', 'spot', 'shop', 'equipment', 'beginner', 'camera', 'skill'];

        foreach ($tag_names as $tag_name) {
            Tag::create([
                'name' => $tag_name
            ]);
        }
    }
}
