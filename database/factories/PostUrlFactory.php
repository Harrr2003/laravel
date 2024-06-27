<?php

namespace Database\Factories;

use App\Models\PostUrl;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostUrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUrl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => 'EHtvaW2reLzB9B94i19tKawtYZFED2mXDA4Ps35E.jpg',
        ];
    }
}
