<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
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
        $labels = Label::all();
        $products = Product::all();
        $categories = Category::all();

        foreach ($users as $user) {
            Ticket::factory(10)
                ->state([
                    'user_id' => $user->id,
                    'product_id' => $products->random()->id,
                    'category_id' => $categories->random()->id,
                ])
                ->hasAttached($labels->random(3), [], 'labels')
                ->hasAttached($agents->random(3), [], 'assignees')
                ->create();
        }
    }
}
