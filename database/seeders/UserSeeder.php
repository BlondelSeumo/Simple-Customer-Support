<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::upsert([
            [
                'name' => 'Demo User',
                'email' => 'user@ticksify.com',
                'password' => bcrypt('password'),
            ],
        ], 'email');

        User::factory()->count(100)->create();
    }
}
