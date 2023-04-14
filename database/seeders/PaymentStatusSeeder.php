<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::query()->insert([
            [
                'name' => 'Pending',
                'description' => 'The payment process has not been completed and is being processed.',
                'color' => 'yellow'
            ],[
                'name' => 'Paid',
                'description' => 'The payment process has been completed and payment has been received.',
                'color' => 'green'
            ],[
                'name' => 'Failed',
                'description' => 'The payment process has failed and payment has not been received.',
                'color' => 'red'
            ],[
                'name' => 'Refunded',
                'description' => 'The payment has been refunded or returned.',
                'color' => 'purple'
            ],[
                'name' => 'Chargeback',
                'description' => 'The payment amount has been reversed or returned.',
                'color' => 'darkgray'
            ],[
                'name' => 'Authorized',
                'description' => 'The payment process has been authorized but not yet completed.',
                'color' => 'aqua'
            ],[
                'name' => 'Voided',
                'description' => 'The payment process has been cancelled and payment has not been received.',
                'color' => 'gray'
            ],[
                'name' => 'Processing',
                'description' => 'The payment process is being processed and is waiting.',
                'color' => 'orange'
            ],
        ]);
    }
}
