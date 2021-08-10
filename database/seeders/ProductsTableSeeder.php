<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
                'title'=>'iPhone X 64GB',
                'img'=>'iphone_x.jpeg',
                'text'=>'Отличный продвинутый телефон с памятью на 64 gb'
                'alias'=>'iphone_x',
                'category_id'=>'1',
                'price'=>'35500',
            ],
            [
                'title'=>'iPhone X 256GB',
                'img'=>'iphone_x_silver.jpeg',
                'text'=>'Отличный продвинутый телефон с памятью на 256 gb'
                'alias'=>'iphone_x_silver',
                'category_id'=>'1',
                'price'=>'45200',
            ],
            [
                'title'=>'HTC One S',
                'img'=>'htc_one_s.png',
                'text'=>'Зачем платить за лишнее? Легендарный HTC One S'
                'alias'=>'htc_one_s',
                'category_id'=>'1',
                'price'=>'6100',
            ],
            [
                'title'=>'iPhone 5SE',
                'img'=>'iphone_5.jpeg',
                'text'=>'Отличный классический iPhone'
                'alias'=>'iphone_5',
                'category_id'=>'1',
                'price'=>'7900',
            ],
            [
                'title'=>'Samsung Galaxy J6',
                'img'=>'samsung_j6.jpeg',
                'text'=>'Современный телефон начального уровня'
                'alias'=>'samsung_j6',
                'category_id'=>'1',
                'price'=>'5700',
            ],
            [
                'title'=>'Наушники Beats Audio',
                'img'=>'beats.jpeg',
                'text'=>'Отличный звук от Dr. Dre'
                'alias'=>'beats',
                'category_id'=>'2',
                'price'=>'9800',
            ],
            [
                'title'=>'Камера GoPro',
                'img'=>'gopro.jpeg',
                'text'=>'Снимай самые яркие моменты с помощью этой камеры'
                'alias'=>'gopro',
                'category_id'=>'2',
                'price'=>'5800',
            ],
            [
                'title'=>'Камера Panasonic HC-V770',
                'img'=>'video_panasonic.jpeg',
                'text'=>'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!'
                'alias'=>'video_panasonic',
                'category_id'=>'2',
                'price'=>'13700',
            ],
            [
                'title'=>'Кофемашина DeLongi',
                'img'=>'delongi.jpeg',
                'text'=>'Хорошее утро начинается с хорошего кофе!'
                'alias'=>'delongi',
                'category_id'=>'3',
                'price'=>'12600',
            ],
            [
                'title'=>'Холодильник Haier',
                'img'=>'haier.jpeg',
                'text'=>'Для большой семьи большой холодильник!'
                'alias'=>'haier',
                'category_id'=>'3',
                'price'=>'20100',
            ],
            [
                'title'=>'Блендер Moulinex',
                'img'=>'moulinex.jpeg',
                'text'=>'Для самых смелых идей'
                'alias'=>'moulinex',
                'category_id'=>'3',
                'price'=>'2100',
            ],
            [
                'title'=>'Мясорубка Bosch',
                'img'=>'bosch.jpeg',
                'text'=>'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!'
                'alias'=>'bosch',
                'category_id'=>'3',
                'price'=>'4600',
            ],
        ]);
    }
}
