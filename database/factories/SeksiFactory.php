<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seksi>
 */
class SeksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        
        'seksi' => $this->faker->regexify('[A-Z]{3}'),
        'departemen_id' => $this->faker->randomDigitNotNull()
                          
        ];
    }
}
