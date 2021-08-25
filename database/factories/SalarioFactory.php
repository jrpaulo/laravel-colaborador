<?php

namespace Database\Factories;

use App\Models\Salario;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_colaborador' => $this->faker->randomDigitNotNull,
        'salario' => $this->faker->word,
        'data_inicio' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
