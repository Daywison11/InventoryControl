<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class itensFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'codigo' => $this->faker->randomNumber(5),
            'nome' => $this->faker->name,
            'tipo' => $this->faker->tipo,
            'valor-un-compra' => $this->faker->randomFloat(2,3,300),
            'valor-un-venda' => $this->faker->randomFloat(2, 3, 300),
            'estoque-gerado' => $this->faker->randomNumber(7),
            'estoque-disponivel' => $this->faker->randomNumber(7),
            'entradas' => $this->faker->randomNumber(7),
            'saidas' => $this->faker->randomNumber(7),
            'perca' => $this->faker->randomNumber(7)
        ];
    }
}
