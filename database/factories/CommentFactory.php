<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'commentator_id' => Agent::factory(),
            'commentator_type' => Agent::class,
            'commentable_id' => Ticket::factory(),
            'commentable_type' => Ticket::class,
            'content' => $this->faker->realText,
        ];
    }
}
