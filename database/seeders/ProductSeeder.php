<?php

namespace Database\Seeders;

use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductModel::query()->insert([
            [
                'title' => 'Monitör',
                'description' => '10 Numara monitör bu aga',
                'price' => 1550
            ],
            [
                'title' => 'Klavye',
                'description' => '10 Numara klavye bu aga',
                'price' => 240
            ],
            [
                'title' => 'Mouse',
                'description' => '10 Numara mouse bu aga',
                'price' => 31.5
            ],
        ]);
    }
}
