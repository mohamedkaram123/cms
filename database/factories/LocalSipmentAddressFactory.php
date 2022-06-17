<?php

namespace Database\Factories;

use App\Models\LocalSipmentAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalSipmentAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocalSipmentAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "address" => $this->faker->text(),
            "city_id" => rand(12, 116),
            "country_id" => rand(1, 193),
            "governorate_id" => rand(3001, 4001),
            "cost" => rand(100, 600),
            "shipping_days" => rand(1, 20)
            //
        ];
    }
}
