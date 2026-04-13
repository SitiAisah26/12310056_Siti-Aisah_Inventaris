<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'     => 'admin wikrama',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin'), 
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'operator wikrama',
            'email'    => 'operator@gmail.com',
            'password' => Hash::make('operator'), 
            'role'     => 'operator',
        ]);
    }
}
