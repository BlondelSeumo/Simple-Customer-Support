<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name' => Str::ucfirst($name),
            'slug' => Str::slug($name),
            'color' => Str::substr($this->faker->hexColor, 1),
            'description' => $this->faker->sentence,
        ];
    }
}
