<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                CategorySeeder::class,
                UserSeeder::class,
                ProductSeeder::class,
                OrderStatusSeeder::class,
                OrderDeliveryMethodSeeder::class,
                OrderSeeder::class,
            ]
        );
    }
}
