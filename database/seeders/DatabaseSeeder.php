<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed bahagian dahulu
        $this->call(BahagianSeeder::class);

        // Cipta Admin (BHG ICT - id 32)
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'bahagian_id' => 32,
        ]);

        // Cipta Pengguna Biasa (BHG PSM - id 29)
        User::factory()->create([
            'name' => 'Pengguna',
            'email' => 'pengguna@test.com',
            'bahagian_id' => 29,
        ]);

        // Pengguna dummy tambahan (optional)
        // User::factory(5)->create();
    }
}
