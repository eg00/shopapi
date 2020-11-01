<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = User::all()->count();
        return [
            'user_id' => random_int(2, $count),
            'delivery_method_id' => random_int(1, 3),
            'status_id' => random_int(1, 5),
        ];
    }
}
