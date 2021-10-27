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

        $currencies_banks = DB::table('banks_currencies', 'bc')
            ->select(
                'currencies.name_currency',
                'currencies.slug_currency',
                'currencies.short_name_currency',
                'banks.name_bank',
                'banks.description_bank',
                'banks.slug_bank',
                'bc.price',
                'bc.created_at',
            )
            ->leftJoin('currencies', 'currencies.id', '=', 'currency_id')
            ->leftJoin('banks', 'banks.id', '=', 'bank_id')
            ->where('bc.created_at', 'like', '%' . $date . '%')
            ->get();

        return view('welcome', compact('currencies_banks', 'banks', 'currencies'));
    }
}
