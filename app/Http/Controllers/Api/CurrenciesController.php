<?php

namespace App\Http\Controllers\Api;

use App\Entity\Currency;
use App\User;
use App\Http\Requests\CurrencyUpdateRateRequest;
use App\Http\Controllers\Controller;
use App\Jobs\SendRateChangedEmail;
use Illuminate\Support\Facades\Gate;

class CurrenciesController extends Controller
{
    public function updateRate(CurrencyUpdateRateRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('update', $currency)) {
            abort(403);
        }
        $oldRate = $currency->rate;
        $currency->rate = $request->input('rate');
        $currency->save();
        $users = User::all();
        foreach ($users as $user) {
            SendRateChangedEmail::dispatch($user, $currency, $oldRate)->onQueue('notification');
        }
        return response()->json($currency);
    }
}
