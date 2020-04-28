<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExchangeRateCollection;
use App\Models\Currency;

class IndexController extends Controller
{
    public function index()
    {
        $currencies = Currency::with('exchangeRates')->orderBy('updated_at')->paginate(5);
        $exchange_rates = new ExchangeRateCollection($currencies);
        return view('index')->with([
            'exchange_rates' => $exchange_rates
        ]);
    }
}
