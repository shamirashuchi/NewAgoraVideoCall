<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\JobBoard\Models\Currency;

class CurrencySeeder extends BaseSeeder
{
    public function run(): void
    {
        Currency::truncate();

        $currencies = [
            [
                'title' => 'USD',
                'symbol' => '$',
                'is_prefix_symbol' => true,
                'order' => 0,
                'decimals' => 0,
                'is_default' => 1,
                'exchange_rate' => 1,
            ],
            [
                'title' => 'EUR',
                'symbol' => '€',
                'is_prefix_symbol' => false,
                'order' => 1,
                'decimals' => 0,
                'is_default' => 0,
                'exchange_rate' => 0.84,
            ],
            [
                'title' => 'VND',
                'symbol' => '₫',
                'is_prefix_symbol' => false,
                'order' => 1,
                'decimals' => 0,
                'is_default' => 0,
                'exchange_rate' => 23203,
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
