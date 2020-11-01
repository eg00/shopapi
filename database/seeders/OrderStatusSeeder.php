<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::query()->insert(
            [
                ['name' => 'принят'],
                ['name' => 'отгружен'],
                ['name' => 'у курьера'],
                ['name' => 'доставлен'],
                ['name' => 'отмена'],
            ]
        );
    }
}
