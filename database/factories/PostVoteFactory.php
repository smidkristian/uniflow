<?php

namespace Database\Factories;

use App\Models\PostVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostVote::class;

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
            "vote" => $this->faker->boolean(50)
        ];
    }
}
