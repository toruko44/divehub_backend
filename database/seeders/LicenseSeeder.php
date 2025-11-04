<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\License;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licenses = [
            'novice',
            'open',
            'advance',
            'special',
            'master',
            'instructor'
        ];

        foreach ($licenses as $license) {
            License::create([
                'name' => $license
            ]);
        }
    }
}
