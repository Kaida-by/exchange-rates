<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $banks = Bank::all();
        $currencies = Currency::all();

        $date = today()->subDays(1)->format('Y-m-d');

//        $currencies_banks = DB::table('banks_currencies', 'bc')
//            ->select(
//                'currencies.name_currency',
//                'currencies.slug_currency',
//                'currencies.short_name_currency',
//                'banks.name_bank',
//                'banks.description_bank',
//                'banks.slug_bank',
//                'bc.price',
//                'bc.created_at',
//            )
//            ->leftJoin('currencies', 'currencies.id', '=', 'currency_id')
//            ->leftJoin('banks', 'banks.id', '=', 'bank_id')
//            ->where('bc.created_at', 'like', '%' . $date . '%')
//            ->get();

        $prices = DB::table('currencies', 'c')
            ->select('*')
            ->leftJoin('banks_currencies', 'c.id', '=', 'banks_currencies.currency_id')
            ->where('banks_currencies.created_at', 'like', '%' . $date . '%')
            ->get();

        $currencies_banks = [];

        foreach ($prices as $price) {
            $currencies_banks[$price->currency_id]['name_currency'] = $price->name_currency;
            $currencies_banks[$price->currency_id]['slug_currency'] = $price->slug_currency;
            $currencies_banks[$price->currency_id]['short_name_currency'] = $price->short_name_currency;
            $currencies_banks[$price->currency_id]['background'] = $price->background;
            $currencies_banks[$price->currency_id]['created_at'] = $price->created_at;
            $currencies_banks[$price->currency_id]['updated_at'] = $price->updated_at;
            $currencies_banks[$price->currency_id]['price'][] = $price->price;
        }

        return view('content', compact('currencies_banks', 'banks', 'currencies'));
    }
}
