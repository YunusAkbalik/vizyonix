<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::query()->insert([
            [
                'name' => "Processing",
                'description' => "Your order has not yet been prepared and is being processed.",
                'color' => "warning"
            ], [
                'name' => "Shipped",
                'description' => "Your order has been shipped and is in transit.",
                'color' => "primary"
            ], [
                'name' => "Delivered",
                'description' => "Your order has been delivered and reached the customer.",
                'color' => "success"
            ], [
                'name' => "Cancelled",
                'description' => "Your order has been cancelled and no action has been taken.",
                'color' => "danger"
            ], [
                'name' => "Returned",
                'description' => "Your order has been returned and the refund process has started.",
                'color' => "info"
            ], [
                'name' => "On Hold",
                'description' => "Your order has been put on hold for a reason and cannot be processed further.",
                'color' => "danger"
            ], [
                'name' => "Ready for Pickup",
                'description' => "Your order is ready and waiting for the customer to pick up.",
                'color' => "success"
            ], [
                'name' => "Out of Stock",
                'description' => "The products in your order are out of stock and the order cannot be processed.",
                'color' => "danger"
            ],
        ]);
    }
}
