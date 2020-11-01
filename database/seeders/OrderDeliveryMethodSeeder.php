<?php

namespace Database\Seeders;

use App\Models\OrderDeliveryMethod;
use Illuminate\Database\Seeder;

class OrderDeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDeliveryMethod::query()->insert(
            [
                ['name' => 'Курьерская доставка с оплатой при получении'],
                ['name' => 'Почта России с наложенным платежом'],
                ['name' => 'Доставка через терминалы QIWI Post'],
            ]
        );
    }
}
