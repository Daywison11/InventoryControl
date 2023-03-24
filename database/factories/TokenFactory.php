<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'token' => strval(bin2hex(random_bytes(32))),
            'nome' => $this->faker->words(1, true),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
