<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $exchangeRates = config('exchange_rates');
        return view('exchange_rates.index', compact('exchangeRates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:3',
            'rate' => 'required|numeric',
        ]);

        $exchangeRates = config('exchange_rates');
        $exchangeRates[$request->currency] = $request->rate;

        $this->writeConfig($exchangeRates);
        return redirect()->route('exchange-rates.index');
    }

    public function update(Request $request, $currency)
    {
        $request->validate([
            'rate' => 'required|numeric',
        ]);

        $exchangeRates = config('exchange_rates');
        $exchangeRates[$currency] = $request->rate;

        $this->writeConfig($exchangeRates);
        return redirect()->route('exchange-rates.index');
    }

    public function destroy($currency)
    {
        $exchangeRates = config('exchange_rates');
        unset($exchangeRates[$currency]);

        $this->writeConfig($exchangeRates);
        return redirect()->route('exchange-rates.index');
    }

    private function writeConfig($exchangeRates)
    {
        $configPath = config_path('exchange_rates.php');
        $content = '<?php return ' . var_export($exchangeRates, true) . ';';
        file_put_contents($configPath, $content);
    }
}
