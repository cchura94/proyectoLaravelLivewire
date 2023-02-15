<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
			'nombre_completo' => $this->faker->name,
			'ci_nit' => $this->faker->name,
			'telefono' => $this->faker->name,
			'direccion' => $this->faker->name,
        ];
    }
}
