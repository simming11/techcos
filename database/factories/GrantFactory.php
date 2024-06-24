<?php

namespace Database\Factories;

use App\Models\Grant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrantFactory extends Factory
{
    protected $model = Grant::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'user_id' => User::factory(),
        ];
    }
}
