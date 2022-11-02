<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Default Admin Credentials;
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'zeeshan.sidtechno@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Loop to generate random data for the user's, news', promo's Tables;
        for ($i = 0; $i < 200; $i++) {
            DB::table('users')->insert([
                'first_name' => Str::random(6),
                'last_name' => Str::random(6),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => date("Y-m-d H:i:s", mt_rand(1640998800, 1672534800)),
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            DB::table('news')->insert([
                'user_id' => 1,
                'title' => Str::random(12),
                'description' => Str::random(100),
                'date' => Carbon::today()->subDays(rand(1, 365)),
                'views' => random_int(1, 99),
                'likes' => random_int(1, 99),
                'created_at' => Carbon::today()->subDays(rand(1, 365)),
            ]);


            DB::table('promotions')->insert([
                'name' => Str::random(12),
                'user_id' => 1,
                'image' => 'default.png',
                'url' => Str::random(10),
                'clicks' => random_int(1, 99),
                'views' => random_int(1, 99),
                'start_date' => Carbon::today()->subDays(rand(1, 365)),
                'exp_date' => Carbon::today()->subDays(rand(1, 365)),
                'created_at' => Carbon::today()->subDays(rand(1, 365)),
            ]);
        }
    }
}
