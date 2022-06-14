<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::firstOrCreate(['payment' => 'Картой онлайн']);
        Payment::firstOrCreate(['payment' => 'Картой при получении']);
        Payment::firstOrCreate(['payment' => 'Наличными при получении']);
    }
}
