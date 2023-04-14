<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::query()->insert([
            [
                'name' => 'Yunus Emre Akbalık',
                'email' => 'yunusroose@gmail.com',
                'phone' => '+90 536 765 34 03',
                'address' => 'Ferhatpaşa Mh.',
                'city' => 'Istanbul',
                'state' => 'Atasehir',
                'zip' => '34888',
                'country' => 'Turkey',
                'payment_method' => 'Credit Card',
                'payment_status' => 1,
                'order_status' => 1,
                'total_price' => 950,
                'coupon_code' => 'FREE50',
                'coupon_discount' => '50',
                'shipping_amount' => 25,
                'grand_total' => 925,
                'note' => 'Fast plz',
                'user_id' => 1,
                'coupon_id' => 1,
                'shipping_id' => 1,
                'payment_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
