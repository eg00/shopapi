<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'product_price', 'count', 'variation'];

    protected $with = ['product'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'item_id');
    }
    public function getTotalPriceAttribute()
    {
        return $this->product_price * $this->count;
    }
}
