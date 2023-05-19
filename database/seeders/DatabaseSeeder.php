<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

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
        
        DB::table('users')->insert([
            'name' => 'Jonas3',
            'email' => 'jonas3@gmail.com',
            'password' => Hash::make('abc123'),
            'role' => 10,
        ]);
        
        DB::table('users')->insert([
            'name' => 'Jonas4',
            'email' => 'jonas4@gmail.com',
            'password' => Hash::make('abc123'),
            'role' => 10,
        ]);
        
        DB::table('users')->insert([
            'name' => 'Jonas5',
            'email' => 'jonas5@gmail.com',
            'password' => Hash::make('abc123'),
            'role' => 10,
        ]);

        $faker = Faker::create();

        foreach(range(1, 15) as $_) {
            DB::table('countries')->insert([
                'title' => $faker->country,
                'season' => rand(1, 4)
            ]);
        }

        foreach(range(1, 30) as $_) {
            DB::table('hotels')->insert([
                'title' => $faker->company,
                'cost' => rand(1,999)+ rand(0,99)/100,
                'country_id' => rand(1,15),
                'duration'=> rand(1, 100).' days'
            ]);
        }

        foreach(range(1, 15) as $_) {
            DB::table('reservations')->insert([
                'user_id' => rand(2,5),
                'hotel_id' => rand(1,30),
                'approved' => rand(0,1),
            ]);
        }

    }
}
