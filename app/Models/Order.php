<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['status', 'user', 'product'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['count', 'total'];

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function delivery()
    {
        return $this->hasOne(OrderDeliveryMethod::class, 'id', 'delivery_method_id');
    }

    public function getTotalAttribute()
    {
        return $this->product->reduce(fn($total, $product) => $total + $product->total_price, 0);
    }

    public function getCountAttribute()
    {
        return $this->product->reduce(fn($total, $product) => $total + $product->count, 0);
    }
    public function productData()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderProduct::class,
            'order_id',
            'id'
        );
    }
}
