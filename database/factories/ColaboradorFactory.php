<?php

namespace Database\Factories;

use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColaboradorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Colaborador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
        'cpf' => $this->faker->word,
        'rg' => $this->faker->word,
        'datanascimento' => $this->faker->word,
        'cep' => $this->faker->word,
        'endereco' => $this->faker->word,
        'numero' => $this->faker->randomDigitNotNull,
        'cidade' => $this->faker->word,
        'estado' => $this->faker->word,
        'email' => $this->faker->word
        ];
    }
}
