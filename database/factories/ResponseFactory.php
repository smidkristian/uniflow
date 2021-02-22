<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Response::class;

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
            'post_id' => $this->faker->numberBetween(1, 10),
            'response' => $this->faker->text(40),
            'created_at' => now(),
            'created_at' => now(),
        ];
    }
}
