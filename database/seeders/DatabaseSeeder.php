<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\Response;
use App\Models\ResponseVote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kristian',
            'email' => 'smid.kristian@gmail.com',
            'username' => 'smidkristian',
            'password' => Hash::make('dostojevskij')
        ]);

        User::factory(10)->create();
        Post::factory(30)->create();
        Response::factory(100)->create();
        PostVote::factory(30)->create();
        ResponseVote::factory(100)->create();
    }
}
