<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrCreate(['title' => 'Трикотаж', 'trans' => 'trikotaz', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Куртки и Пальто', 'trans' => 'kurtki', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Брюки', 'trans' => 'bruki', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Юбки', 'trans' => 'ubki', 'not_for_men' => '1']);
        Category::firstOrCreate(['title' => 'Рубашки и блузки', 'trans' => 'rubashki', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Футболки и толстовки', 'trans' => 'futbolki', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Джинсы', 'trans' => 'dzinsi', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Пиджаки', 'trans' => 'pidzaki', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Платья и комбинезоны', 'trans' => 'platya', 'not_for_men' => '1']);
        Category::firstOrCreate(['title' => 'Обувь', 'trans' => 'obuv', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Аксессуары', 'trans' => 'aksessuari', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Нижнее бельё', 'trans' => 'nizneeBelyo', 'not_for_men' => '0']);
        Category::firstOrCreate(['title' => 'Домашняя одежда', 'trans' => 'domashnyaOdezda', 'not_for_men' => '0']);
    }
}
