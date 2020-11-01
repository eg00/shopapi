<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(100)->create()->each(function ($order) {
            $order->product()->saveMany(OrderProduct::factory()->count(random_int(2,20))->make());
        });
    }
}
