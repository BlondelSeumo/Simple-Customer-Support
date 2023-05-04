<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $agents = Agent::all();
        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {
            Comment::factory(5)
                ->sequence(
                    ['commentator_type' => User::class, 'commentator_id' => $users->random()->id],
                    ['commentator_type' => Agent::class, 'commentator_id' => $agents->random()->id],
                )
                ->for($ticket, 'commentable')
                ->create();
        }
    }
}
