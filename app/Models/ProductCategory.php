<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "product_category";
    protected $guarded = [];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
