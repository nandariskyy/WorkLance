<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = base_path('data.sql');
        if (file_exists($path)) {
            \Illuminate\Support\Facades\DB::unprepared(file_get_contents($path));
            $this->command->info('Database seeded successfully from data.sql');
        } else {
            $this->command->error('data.sql file not found in root directory.');
        }
    }
}
