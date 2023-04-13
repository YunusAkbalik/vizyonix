<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $guarded = [];

    public function image(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(ProductCategory::class , 'product_id')->with('category');
    }
}
