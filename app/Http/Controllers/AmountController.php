<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmountController extends Controller
{
    public function index()
    {
        $amounts = Amount::where('user_id', Auth::id())->latest()->get();
        $exchangeRates = config('exchange_rates');
        $currencies = array_keys($exchangeRates);
        return view('amounts.index', compact('amounts', 'exchangeRates', 'currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|max:3',
            'amount' => 'required|numeric',
        ]);

        Amount::create([
            'user_id' => Auth::id(),
            'currency' => $request->currency,
            'amount' => $request->amount,
        ]);
        return redirect()->route('amounts.index');
    }

    public function update(Request $request, Amount $amount)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $amount->update($request->all());
        return redirect()->route('amounts.index');
    }

    public function destroy(Amount $amount)
    {
        $amount->delete();
        return redirect()->route('amounts.index');
    }
}
