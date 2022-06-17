<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

class GovernorateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Governorate::class;

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
            "country_id" => rand(1, 193),
            "updated_at" => now(),



        ];
    }
}
