<?php

namespace Database\Factories;

use App\Models\ResponseVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResponseVote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all();

        return [
            "user" => $users[$this->faker->numberBetween(1, 10)]->username,
            "post_id" => $this->faker->numberBetween(1, 30),
            "response_id" => $this->faker->numberBetween( 1, 100),
            "vote" => $this->faker->boolean(50)
        ];
    }
}
