<?php

namespace App\Http\Controllers;

use App\Entity\Currency;
use App\User;
use App\Jobs\SendRateChangedEmail;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Support\Facades\Gate;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', ['currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create', Currency::class)) {
            abort(403);
        }
        return view('currencies.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        if (Gate::denies('create', Currency::class)) {
            abort(403);
        }
        $data = $request->only(['name', 'short_name', 'logo_url', 'rate']);
        $currency = new Currency($data);
        $currency->save();
        $currencies = Currency::all();
        return view('currencies.index', ['currencies' => $currencies]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('view', $currency)) {
            abort(403);
        }
        return view('currencies.show', ['currency' => $currency]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('update', $currency)) {
            abort(403);
        }
        return view('currencies.edit', ['currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('update', $currency)) {
            abort(403);
        }
        $currency->name = $request->input('name');
        $currency->short_name = $request->input('short_name');
        $currency->logo_url = $request->input('logo_url');
        if ($currency->rate != $request->input('rate')) {
            $oldRate = $currency->rate;
        }
        $currency->rate = $request->input('rate');
        $currency->save();

        if (!empty($oldRate)) {
            $users = User::where('is_admin', false)->get();
            foreach ($users as $user) {
                SendRateChangedEmail::dispatch($user, $currency, $oldRate)->onQueue('notification');
            }
        }

        return redirect()->route('currencies.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        if (Gate::denies('delete', $currency)) {
            return redirect('/');
        }
        $currency->delete();
        return redirect()->route('currencies.index');
    }
}
