<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImage::query()->insert([
            [
                'product_id' => 1,
                'path' => '/media/images/product.jpg'
            ], [
                'product_id' => 2,
                'path' => '/media/images/product.jpg'
            ], [
                'product_id' => 3,
                'path' => '/media/images/product.jpg'
            ],
        ]);
    }
}
