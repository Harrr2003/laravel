<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'aaa',
                'email' => 'user' . $i . '@example.com', // Using a simple email pattern for uniqueness
                'password' => Hash::make('password123'),
                'gender' => 'male',
                'avatar' => 'images/male.png',
                'password_reset_token' => Str::random(60),
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
