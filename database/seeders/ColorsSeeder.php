<?php

namespace Database\Seeders;

use App\Models\Colors;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Colors::firstOrCreate(['color' => 'Белый']);
        Colors::firstOrCreate(['color' => 'Бежевый']);
        Colors::firstOrCreate(['color' => 'Бирюзовый']);
        Colors::firstOrCreate(['color' => 'Бордовый']);
        Colors::firstOrCreate(['color' => 'Голубой']);
        Colors::firstOrCreate(['color' => 'Желтый']);
        Colors::firstOrCreate(['color' => 'Зеленый']);
        Colors::firstOrCreate(['color' => 'Золотой']);
        Colors::firstOrCreate(['color' => 'Коралловый']);
        Colors::firstOrCreate(['color' => 'Красный']);
        Colors::firstOrCreate(['color' => 'Мультиколор']);
        Colors::firstOrCreate(['color' => 'Оранжевый']);
        Colors::firstOrCreate(['color' => 'Серебряный']);
        Colors::firstOrCreate(['color' => 'Серый']);
        Colors::firstOrCreate(['color' => 'Синий']);
        Colors::firstOrCreate(['color' => 'Фиолетовый']);
        Colors::firstOrCreate(['color' => 'Фуксия']);
        Colors::firstOrCreate(['color' => 'Хаки']);
        Colors::firstOrCreate(['color' => 'Черный']);
    }
}
