<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->categoryProduct()->delete();
        });
    }

    public function categoryProduct(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'category_id');
    }
}
