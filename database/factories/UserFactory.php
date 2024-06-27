<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'aaa',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'gender' => 'male',
            'avatar' => 'images/male.png',
            'password_reset_token' => Str::random(60),
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
