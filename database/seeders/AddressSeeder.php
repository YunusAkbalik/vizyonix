<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::query()->insert([
            [
                'name' => 'Home',
                'username' => 'Yunus Emre Akbalık',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'zip' => '12345',
                'country' => 'USA',
                'phone' => '+90 536 765 34 03',
                'email' => 'yunusroose@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
