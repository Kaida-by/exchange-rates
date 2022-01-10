<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Currency;
use App\Services\IndexService;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        $banks = Bank::all();
        $currencies = Currency::all();
        $prices = IndexService::getPrises();

        $currencies_banks = IndexService::getCurrenciesBanks($prices);
        $dates = IndexService::getDatesForCharts();

        return new Response(view('content', compact(
            'currencies_banks', 'banks', 'currencies', 'dates'
        )));
    }
}
