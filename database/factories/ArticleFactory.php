<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $content = '';
        $keywords = ['help desk software', 'ticketing system', 'envato API integration'];
        $paragraphs = $this->faker->paragraphs(rand(6, 10));
        foreach ($paragraphs as $paragraph) {
            $content .= '<p>' . $paragraph . ' ' . $this->faker->randomElement($keywords) . '</p>';
        }

        return [
            'author_id' => Agent::factory(),
            'collection_id' => Collection::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->paragraph,
            'content' => $content,
            'published_at' => $this->faker->dateTimeBetween('-30 days'),
        ];
    }
}
