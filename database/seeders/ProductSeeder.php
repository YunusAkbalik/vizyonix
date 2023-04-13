<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->insert([
            [
                'title' => 'Klavye',
                'description' => "Bu güzel bir klavye",
                'price' => 209.90,
                'on_sale' => true,
                'main_image' => "/media/images/product.jpg"
            ],
            [
                'title' => 'Monitör',
                'description' => "360 hz monitör",
                'price' => 4950,
                'on_sale' => true,
                'main_image' => "/media/images/product.jpg"
            ],
            [
                'title' => 'Cloud II',
                'description' => "Yeni model Cloud II",
                'price' => 2850,
                'on_sale' => false,
                'main_image' => "/media/images/product.jpg"
            ]
        ]);
    }
}
