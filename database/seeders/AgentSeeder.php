<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::upsert([
            [
                'name' => 'Demo Admin',
                'email' => 'admin@ticksify.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ], [
                'name' => 'Demo Agent',
                'email' => 'agent@ticksify.com',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ],
        ], 'email');

        Agent::factory()->count(10)->create();
    }
}
