<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Jonas',
            'email' => 'jonas@gmail.com',
            'password' => Hash::make('abc123'),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Jonas2',
            'email' => 'jonas2@gmail.com',
            'password' => Hash::make('abc123'),
            'role' => 10,
        ]);
    }
}
