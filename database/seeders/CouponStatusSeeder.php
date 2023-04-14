<?php

namespace Database\Seeders;

use App\Models\CouponStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CouponStatus::query()->insert([
            ['status' => "Such as available"],
            ['status' => "Used"],
            ['status' => "Invalid"],
            ['status' => "Expired"],
        ]);
    }
}
