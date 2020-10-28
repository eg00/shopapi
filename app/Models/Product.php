<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts
        = [
            'variations' => 'array',
            'is_recommended' => 'boolean',
            'is_available' => 'boolean',
        ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->take(8);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function getSpacedPriceAttribute()
    {
        return substr_replace($this->price, ' ', strlen($this->price) - 3, 0);
    }

    public function getSpacedSalePriceAttribute()
    {
        return substr_replace($this->sale_price, ' ', strlen($this->sale_price) - 3, 0);
    }
}
