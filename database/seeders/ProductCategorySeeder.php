<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::query()->insert([
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 2,
                'category_id' => 2,
            ],
            [
                'product_id' => 3,
                'category_id' => 3,
            ],
        ]);
    }
}
