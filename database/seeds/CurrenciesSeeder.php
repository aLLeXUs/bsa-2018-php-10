<?php

use App\Entity\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    const DATA = [
        [
            'name' => 'Bitcoin',
            'short_name' => 'btc',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/1831.png',
            'rate' => 725.55
        ],
        [
            'name' => 'Ethereum',
            'short_name' => 'eth',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/1027.png',
            'rate' => 454.03
        ],
        [
            'name' => 'XRP',
            'short_name' => 'xrp',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/52.png',
            'rate' => 0.455
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::query()->insert(self::DATA);
    }
}
