<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      //$usersID = sys::table('users')->pluck('id');
        return [
            'name' => fake()->realText(10, 2),
            'price' => mt_rand(0, 1000),
            'description' => fake()->realText(30, 1),
            'user_id' => mt_rand(1, 100),

        ];
    }
}
