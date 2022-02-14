<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($this->faker));
        $suffix = rand(0, 1) ? " - x" : "";
        return [
            'name' => "{$this->faker->unique()->department}$suffix"

        ];
    }
}
