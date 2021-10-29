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
        $dataT = [
            [
                'title' => 'testtitle',
                'url' => 'testurl'
            ],
            [
                'title' => 'qeqweqwe',
                'url' => 'asdxzcxzc'
            ]
        ];
        return new Response(view('content', compact(
            'currencies_banks', 'banks', 'currencies', 'dataT'
        )));
    }

    public function getCharts(): array
    {
        return [
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
