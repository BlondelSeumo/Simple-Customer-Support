<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = Agent::all();
        $collections = \App\Models\Collection::all();

        foreach ($collections as $collection) {
            Article::factory(15)
                ->state(new Sequence(
                    fn($sequence) => ['author_id' => $authors->random()->id],
                ))
                ->for($collection)
                ->create();
        }
    }
}
