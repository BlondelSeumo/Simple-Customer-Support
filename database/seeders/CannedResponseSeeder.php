<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\CannedResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CannedResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = Agent::all();

        $agents->each(function (Agent $agent) {
            CannedResponse::factory(10)->create([
                'agent_id' => $agent->id,
            ]);
        });
    }
}
