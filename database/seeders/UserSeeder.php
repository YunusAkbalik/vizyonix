<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'info@vizyonix.com',
            'password' => bcrypt('123'),
            'phone' => '+905350000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole('admin');
    }
}
