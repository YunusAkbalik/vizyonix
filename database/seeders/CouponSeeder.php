<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::query()->insert([
            [
                'code' => 'FREE50',
                'discount' => 50,
                'min_purchase' => 100,
                'usage_limit' => 1,
                'usage_date' => "14/04/2023 | 14/04/2024",
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
