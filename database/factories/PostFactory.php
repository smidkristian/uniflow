<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();

        return [
            'user' => $users[$this->faker->numberBetween(1, 10)]->username,
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(30),
            'created_at' => now(),
            'created_at' => now(),
        ];
    }
}
