<?php

namespace App\Http\Controllers\Api;

use App\Currency;
use App\Http\Requests\CurrencyUpdateRateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CurrenciesController extends Controller
{
    public function updateRate(CurrencyUpdateRateRequestRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('update', $currency)) {
            abort(403);
        }
        $currency->rate = $request->input('rate');
        $currency->save();
        return response()->json($currency);
    }
}
