<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class productos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'name' => Str::random(10),
            'code' => Str::random(10).'@gmail.com',
            'description' => Str::random(10),
            'price_cost'=>1.10,
            'price_sell'=>1.10,
            
        ]);
    }
}
