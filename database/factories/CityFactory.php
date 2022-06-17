<?php

namespace Database\Factories;

use App\City;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            "created_at" => now(),
            "governorate_id" => rand(3001, 4007),
            "cost" => rand(30, 200),
            "shipping_days" => rand(1, 10),
            "updated_at" => now(),


        ];
    }
}
