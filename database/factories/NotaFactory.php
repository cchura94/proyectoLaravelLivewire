<?php

namespace Database\Factories;

use App\Models\Nota;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotaFactory extends Factory
{
    protected $model = Nota::class;

    public function definition()
    {
        return [
			'detalle' => $this->faker->name,
			'estado' => $this->faker->name,
			'observaciones' => $this->faker->name,
			'pedido_id' => $this->faker->name,
        ];
    }
}
