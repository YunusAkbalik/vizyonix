<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::query()->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 300,
                'discount' => 0,
                'total' => 300,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 650,
                'discount' => 0,
                'total' => 650,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
