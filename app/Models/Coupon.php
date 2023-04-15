<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "coupon";

    public function coupon_status(): HasOne
    {
        return $this->hasOne(CouponStatus::class, 'id', 'status');
    }
}
