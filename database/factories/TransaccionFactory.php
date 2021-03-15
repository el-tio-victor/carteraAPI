<?php

namespace Database\Factories;

use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
	  'transaccion_monto' 	=> $this->faker->numberBetween($min = -100, $max = 200),
	  'descripcion' 	=> $this->faker->text(),
	  'cartera_id' 		=> \App\Models\Cartera::factory()
            //
        ];
    }
}
