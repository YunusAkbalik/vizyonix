<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProductSeeder::class,
            ProductImageSeeder::class,
            CategorySeeder::class,
            ProductCategorySeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
            OrderStatusSeeder::class,
            PaymentStatusSeeder::class,
            CouponSeeder::class,
            CouponStatusSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);
    }
}
