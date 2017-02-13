<?php

use Illuminate\Database\Seeder;

use App\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create(['name' => 'Soles', 'symbol' => 'S/']);
        Currency::create(['name' => 'Dollars', 'symbol' => '$']);
    }
}
