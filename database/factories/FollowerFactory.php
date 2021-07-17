<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FollowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follower::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId1 = User::inRandomOrder()->first()->id;
        $userId2 = User::inRandomOrder()->first()->id;

        return [
            'id' => Str::uuid(),
            'following_id' => $userId1,
            'followed_id' => $userId2
        ];
    }
}
