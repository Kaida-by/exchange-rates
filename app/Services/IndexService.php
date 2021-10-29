<?php

namespace App\Services;

use \Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class IndexService
{
    public static function getCurrenciesBanks(Collection $collection): array
    {
        $tmp = [];

        foreach ($collection as $price) {
            $tmp[$price->currency_id]['currency_id'] = $price->currency_id;
            $tmp[$price->currency_id]['bank_id'] = $price->bank_id;
            $tmp[$price->currency_id]['name_currency'] = $price->name_currency;
            $tmp[$price->currency_id]['slug_currency'] = $price->slug_currency;
            $tmp[$price->currency_id]['short_name_currency'] = $price->short_name_currency;
            $tmp[$price->currency_id]['background'] = $price->background;
            $tmp[$price->currency_id]['created_at'] = $price->created_at;
            $tmp[$price->currency_id]['updated_at'] = $price->updated_at;
            $tmp[$price->currency_id]['price'][] = $price->price;
        }

        $currencies_banks = [];

        foreach ($tmp as $price) {
            $currencies_banks[$price['currency_id']] = $price;
            foreach ($price['price'] as $key => $value) {
                if (min($price['price']) === $value) {
                    $currencies_banks[$price['currency_id']]['prises'][$key]['min'] = true;
                } else {
                    $currencies_banks[$price['currency_id']]['prises'][$key]['min'] = false;
                }
                $currencies_banks[$price['currency_id']]['prises'][$key]['value'] = $value;
            }
            unset($currencies_banks[$price['currency_id']]['price']);
        }

        return $currencies_banks;
    }

    public static function getPrises(): Collection
    {
        $date = today()->subDays(3)->format('Y-m-d');

        return DB::table('currencies', 'c')
            ->select('*')
            ->leftJoin('banks_currencies', 'c.id', '=', 'banks_currencies.currency_id')
            ->where('banks_currencies.created_at', 'like', '%' . $date . '%')
            ->get();
    }

    public function getCharts(): array
    {
        return $charts = [
            [
                'title' => 'testtitle',
                'url' => 'testurl'
            ],
            [
                'title' => 'qeqweqwe',
                'url' => 'asdxzcxzc'
            ]
        ];
    }
}
