<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title'=>'Мобильный телефоны',
                'img'=>'mobile.jpeg',
                'desc'=>'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!'
                'alias'=>'mobiles',
            ],
            [
                'title'=>'Портативная техника',
                'img'=>'portable.jpeg',
                'desc'=>'Раздел с портативной техникой.'
                'alias'=>'portable',
            ],
            [
                'title'=>'Бытовая техника',
                'img'=>'appliance.jpeg',
                'desc'=>'Раздел с бытовой техникой'
                'alias'=>'appliance',
            ],
        ]);
    }
}
