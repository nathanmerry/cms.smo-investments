<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(
            [
                'name' => 'nathan',
                'email' => 'nathanmerry9713@gmail.com',
                'password' => bcrypt('admin'),
                'api_token' => Str::random(60),
            ]
        );
    }
}

