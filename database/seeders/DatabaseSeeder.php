<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Follower;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $dataQuantity = 10;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory($this->dataQuantity)->create();
        Tweet::factory($this->dataQuantity)->create();

        Comment::factory($this->dataQuantity)->create();
        Follower::factory($this->dataQuantity)->create();
        Favorite::factory($this->dataQuantity)->create();
    }
}
