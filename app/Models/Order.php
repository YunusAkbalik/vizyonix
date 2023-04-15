<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $guarded = [];

    public function status(): HasOne
    {
        return $this->hasOne(OrderStatus::class, 'id', 'order_status');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id')->with('product');
    }

    public function paymentStatus(): HasOne
    {
        return $this->hasOne(PaymentStatus::class, 'id', 'payment_status');
    }
}
