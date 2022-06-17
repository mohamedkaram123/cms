<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\RefundRequest;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefundRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order_id = Order::all()->random()->id;
        // $user_id = User::all()->random()->id;

        $order = Order::find($order_id);
        return [
            "order_id" =>  $order_id,
            "user_id" => $order->user_id,
            "amount" => $order->grand_total,
            "status" => $this->faker->randomElement(['pending', 'approval', 'cancelled']),
            "reason" => $this->faker->text()
        ];
    }
}
