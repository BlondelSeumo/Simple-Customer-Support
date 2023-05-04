<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CannedResponse>
 */
class CannedResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'agent_id' => Agent::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'shortcuts' => $this->faker->words,
        ];
    }
}
