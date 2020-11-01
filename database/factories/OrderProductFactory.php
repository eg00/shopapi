<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::query()->inRandomOrder()->first();
        if (!is_null($product->variations)) {
            $variation = $product->variations[array_rand($product->variations)];
        } else {
            $variation = null;
        }
        $price = $product->sale_price ?: $product->price;

        return [
            'product_id'    => $product->id,
            'count'      => random_int(1, 20),
            'product_price' => $price,
            'variation'  => $variation,
        ];
    }
}
