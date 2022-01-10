<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Currency;
use \Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public static function getPrises(Request $request): Collection
    {
        $date = $request->get('date') ?? today()->subDays(100)->format('Y-m-d');

        return DB::table('currencies', 'c')
            ->select('*')
            ->leftJoin('banks_currencies', 'c.id', '=', 'banks_currencies.currency_id')
            ->where('banks_currencies.created_at', 'like', '%' . $date . '%')
            ->where('c.name_currency', 'like', '%' . $request->get('search') . '%')
            ->get();
    }

    public function getCharts(): array
    {
        return [
            'labels' => static::getDate(),
            'datasets' => static::getCurrencies()
        ];
    }

    public static function getDate(): array
    {
        $date = DB::table('banks_currencies')
            ->select('updated_at')
            ->groupBy('updated_at')
            ->get();
        $result = [];

        foreach ($date as $value) {
            $result[] = date('Y-m-d', strtotime($value->updated_at));
        }

        return array_reverse($result);
    }

    public static function getCurrencies($bank_id = 1): array
    {
        $current = today()->format('Y-m');

        if (request()->get('switchDate')) {
            $month = explode('-', request()->get('switchDate'))[1];
        }

        $currencies = DB::table('currencies', 'c')
            ->select('c.id', 'c.name_currency', 'c.background')
            ->get();

        $result = [];

        foreach ($currencies as $key => $currency) {
            $result[$key]['label'] = $currency->name_currency;
            $result[$key]['backgroundColor'] = $currency->background;
            $result[$key]['borderColor'] = $currency->background;

            $data = DB::table('banks_currencies', 'bc')
                ->select('bc.price')
                ->leftJoin('banks', 'bc.bank_id', '=', 'banks.id')
                ->where('bc.bank_id', '=', $bank_id)
                ->where('bc.currency_id', '=', $currency->id)
                ->get();

            $tmp = [];
            foreach ($data as $value) {
                $tmp[] = $value->price;
            }
            $result[$key]['data'] = array_reverse($tmp);
        }

        return $result;
    }

    public static function getDatesForCharts(): array
    {
        $dates = static::getDate();
        $tmp = [];

        foreach ($dates as $date) {
            $tmp[] = date('Y-m', strtotime($date));
        }

        $tmp = array_reverse(array_unique($tmp));
        $result = [];

        foreach ($tmp as $key => $value) {
            $result[$key]['slug'] = $value;
            $result[$key]['label'] = date('Y-F', strtotime($value));
        }

        return $result;
    }
}
