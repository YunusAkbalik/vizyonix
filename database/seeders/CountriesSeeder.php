<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/countries.json');
        $data =  json_decode($json);
        foreach ($data as $obj) {
            Countries::create([
                'name' => utf8_encode($obj->name),
                'code' => utf8_encode($obj->code),
            ]);
        }
    }
}
