<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExchangeRate as ExchangeRateResource;
use App\Http\Resources\CurrencyCollection;
use App\Models\Currency;
use App\Models\ExchangeRate;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;

class ExchangeRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::with('exchangeRates')->get();
        return new CurrencyCollection($currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new GuzzleClient();
        $url = env('EXCHANGE_RATES_API_URL');
        $request = $client->get($url);
        $response = $request->getBody()->getContents();
        $data = json_decode($response);
        $date = $data->date;
        $rates = $data->rates;

        foreach ($rates as $key => $rate) {
            $currencies_array = Currency::pluck('name')->toArray();
            if (!in_array($key, $currencies_array)) {
                $currency = new Currency();
                $currency->name = $key;
                $currency->save();
            }
            $currencies = Currency::select('id')->where('name', $key)->first();

            $rates = new ExchangeRate();
            $rates->currency_id = $currencies->id;
            $rates->rate = $rate;
            $rates->date = $date;
            $rates->save();

        }
        $exchange_rates = ExchangeRate::all();
        $rates = ExchangeRateResource::collection($exchange_rates);
        return $rates;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
