<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProperyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('properties')->insert([
            ['name'=>'new'],
            ['name'=>'hit'],
            ['name'=>'recomend'],
        ]);
    }
}
