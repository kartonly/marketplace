<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::firstOrCreate(['title' => 'Джемперы', 'category_id'=>1, 'trans' => 'dzemperi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Кардиганы', 'category_id'=>1, 'trans' => 'kardigani', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Куртки', 'category_id'=>2, 'trans' => 'kurtki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Пальто', 'category_id'=>2, 'trans' => 'palto', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Пуховики', 'category_id'=>2, 'trans' => 'puhoviki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Плащи', 'category_id'=>2, 'trans' => 'plashi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Джинсовые куртки', 'category_id'=>2, 'trans' => 'dzinsovieKurtki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Жилеты', 'category_id'=>2, 'trans' => 'zileti', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Ветровки', 'category_id'=>2, 'trans' => 'vetrovki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Парки', 'category_id'=>2, 'trans' => 'parki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Брюки', 'category_id'=>3, 'trans' => 'bruki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Шорты', 'category_id'=>3, 'trans' => 'shorti', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Спортивные брюки', 'category_id'=>3, 'trans' => 'sportivnieBruki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Миди', 'category_id'=>4, 'trans' => 'midi', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Мини', 'category_id'=>4, 'trans' => 'mini', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Макси', 'category_id'=>4, 'trans' => 'maxi', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Рубашки', 'category_id'=>5, 'trans' => 'rubashki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Блузы', 'category_id'=>5, 'trans' => 'bluzi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Футболки', 'category_id'=>6, 'trans' => 'futbolki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Поло', 'category_id'=>6, 'trans' => 'polo', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Топы', 'category_id'=>6, 'trans' => 'topi', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Толстовки', 'category_id'=>6, 'trans' => 'tolstovki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Свитшоты', 'category_id'=>6, 'trans' => 'svitshoti', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Олимпийки', 'category_id'=>6, 'trans' => 'olimpiyki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Узкие джинсы', 'category_id'=>7, 'trans' => 'uzkieDzinsi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Свободные джинсы', 'category_id'=>7, 'trans' => 'svobodnieDzinsi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Широкие и расклешенное джинсы', 'category_id'=>7, 'trans' => 'shirokie', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Пиджаки', 'category_id'=>8, 'trans' => 'pidzaki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Костюмы', 'category_id'=>8, 'trans' => 'kostumi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Платья-макси', 'category_id'=>9, 'trans' => 'platyaMaxi', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Платья-миди', 'category_id'=>9, 'trans' => 'platyaMidi', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Платья-мини', 'category_id'=>9, 'trans' => 'platyaMini', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Комбинезоны', 'category_id'=>9, 'trans' => 'kombinezoni', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Босоножки', 'category_id'=>10, 'trans' => 'bosonozki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Ботинки', 'category_id'=>10, 'trans' => 'botinki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Домашняя обувь', 'category_id'=>10, 'trans' => 'domashnayaObuv', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Кроссовки', 'category_id'=>10, 'trans' => 'krossovki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Кеды', 'category_id'=>10, 'trans' => 'kedi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Сапоги', 'category_id'=>10, 'trans' => 'sapogi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Туфли', 'category_id'=>10, 'trans' => 'tufli', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Шнурки', 'category_id'=>10, 'trans' => 'shnurki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Сумки', 'category_id'=>11, 'trans' => 'sumki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Рюкзаки', 'category_id'=>11, 'trans' => 'rukzaki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Шарфы и платки', 'category_id'=>11, 'trans' => 'sharfiPlatki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Головные уборы', 'category_id'=>11, 'trans' => 'golovnieUbori', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Ремни', 'category_id'=>11, 'trans' => 'remni', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Другое', 'category_id'=>11, 'trans' => 'drugoe', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Трусы', 'category_id'=>12, 'trans' => 'trusi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Носки', 'category_id'=>12, 'trans' => 'noski', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Боди', 'category_id'=>12, 'trans' => 'body', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Колготки', 'category_id'=>12, 'trans' => 'kolgotki', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Бюстгалтеры', 'category_id'=>12, 'trans' => 'bustgalteri', 'not_for_men' => '1']);
        Subcategory::firstOrCreate(['title' => 'Пижамы', 'category_id'=>13, 'trans' => 'pizami', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Халаты', 'category_id'=>13, 'trans' => 'halati', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Домашние костюмы', 'category_id'=>13, 'trans' => 'domashnieKostumi', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Футболки и толстовки', 'category_id'=>12, 'trans' => 'futbolkiTolstovki', 'not_for_men' => '0']);
        Subcategory::firstOrCreate(['title' => 'Шорты и штаны', 'category_id'=>12, 'trans' => 'shortiShtani', 'not_for_men' => '0']);
    }
}
